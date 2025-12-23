<?PHP

// Headers CORS pour permettre les requêtes cross-origin depuis localhost
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
$allowed_origins = array(
	'https://localhost',
	'http://localhost',
	'https://127.0.0.1',
	'http://127.0.0.1',
	'https://www.web-dream.fr'
);

if (in_array($origin, $allowed_origins)) {
	header('Access-Control-Allow-Origin: ' . $origin);
}
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	http_response_code(200);
	exit;
}

// Désactiver l'affichage des erreurs AVANT toute autre chose
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Démarrer le buffer de sortie pour capturer toute sortie non désirée
ob_start();

header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

# fonction permettant l'encodage des caractres accentuŽs
function getFormatedText($texte){ 
$texte =utf8_encode($texte); 
$texte =str_replace( "\r", "\n", $texte); 
$texte =str_replace( "<br>","\n", $texte);
$texte =stripcslashes($texte); 
//$texte =str_replace( "'", "\'", $texte); 
//$texte =mysql_real_escape_string($texte); 
//$texte =addslashes($texte);
return $texte; 
} 

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
// Utiliser spl_autoload_register au lieu de __autoload (déprécié)
if(!function_exists("autoload_dbconnect")){ 
	function autoload_dbconnect($class_name){
		$file = 'classes/class_'.$class_name.'.php';
		if (file_exists($file)) {
			require_once($file);
		}
	}
	spl_autoload_register('autoload_dbconnect');
}

// Définir le fichier de log (chemin relatif depuis ce fichier)
$log_file = dirname(dirname(dirname(__FILE__))) . '/application/logs/db_debug.log';

// Détecter si on est en local
$is_local = false;
$hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$local_indicators = array('localhost', '127.0.0.1', '::1', 'local', '.local', '.dev');
foreach ($local_indicators as $indicator) {
	if (stripos($hostname, $indicator) !== false) {
		$is_local = true;
		break;
	}
}
if (!$is_local && filter_var($hostname, FILTER_VALIDATE_IP) !== false) {
	$is_local = true;
}

// Si on est en local, faire une requête cURL vers le serveur de production
if ($is_local) {
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] Mode LOCAL détecté - Proxy vers serveur PRODUCTION\n", FILE_APPEND);
	
	// Préparer les données POST
	$postData = '';
	foreach ($_POST as $k => $v) {
		$postData .= $k . '=' . urlencode($v) . '&';
	}
	$postData = rtrim($postData, '&');
	
	// Faire une requête cURL vers le serveur de production
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.web-dream.fr/dev/rezo_flash_code/info_activite.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Pour éviter les problèmes de certificat
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	
	$output = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	if (curl_errno($ch)) {
		$error = curl_error($ch);
		file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] ERREUR cURL: " . $error . "\n", FILE_APPEND);
		curl_close($ch);
		ob_clean();
		echo "return_txt=-1";
		exit;
	}
	
	curl_close($ch);
	
	if ($httpCode >= 400) {
		file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] ERREUR HTTP: " . $httpCode . "\n", FILE_APPEND);
		ob_clean();
		echo "return_txt=-1";
		exit;
	}
	
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] Réponse du serveur production reçue (HTTP $httpCode)\n", FILE_APPEND);
	ob_clean();
	echo $output;
	exit;
}

// Si on est en production, utiliser la connexion locale normale
// CREATE DATABASE OBJECT
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

$mon_code = isset($_POST['liste_des_codes']) ? $_POST['liste_des_codes'] : '';
$code_PC = isset($_POST['code_PC']) ? $_POST['code_PC'] : '';
$plateforme = isset($_POST['plateforme']) ? $_POST['plateforme'] : '';

file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] liste_des_codes reçue: " . substr($mon_code, 0, 200) . "\n", FILE_APPEND);

if (empty($mon_code)) {
	ob_clean();
	echo "return_txt=-1";
	exit;
}

$mon_array_code=explode("{}",$mon_code);
$mon_array_code=implode("','",$mon_array_code);
$statut="";


// Recherche des mail actif ou inactif
$sql = "SELECT * FROM `REZO` WHERE moncode IN ('$mon_array_code');"; 
file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] SQL SELECT (production): " . substr($sql, 0, 200) . "\n", FILE_APPEND);
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$dernieredateactivee = $db->prepare($row['derniere_inscription']);
							$code =$db->prepare($row['moncode']);
							$ts = strtotime($dernieredateactivee);
							if ($ts<(time()-250))
							{
								$sql = "UPDATE `REZO` SET `statut`='inactif' WHERE `moncode`='$code';";
								$db->query($sql);
							}
						}
					}
}

/********************************************/
if (!empty($code_PC) && !empty($plateforme))
{
	// Échapper les valeurs pour éviter les injections SQL
	$db_connection = $db->Connection();
	$code_PC_escaped = $db_connection->real_escape_string($code_PC);
	$plateforme_escaped = $db_connection->real_escape_string($plateforme);
	
	$sql = "UPDATE `REZO` SET `geolocparpc`='{$code_PC_escaped}',`plateforme`='{$plateforme_escaped}',`date_geolocparpc`=NOW() WHERE moncode IN ('$mon_array_code');";
	
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] SQL UPDATE geolocparpc: " . substr($sql, 0, 200) . "\n", FILE_APPEND);
	$db->query($sql);

}

$resultat="";					
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO` WHERE moncode IN ('$mon_array_code');"; 
file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] SQL SELECT membres (production): " . substr($sql, 0, 200) . "\n", FILE_APPEND);
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$code = $db->prepare($row['moncode']);
							$statut= $db->prepare($row['statut']);
							$nom = stripcslashes($db->prepare($row['nom']));
							$prenom = stripcslashes($db->prepare($row['prenom']));
							$indicatif = stripcslashes($db->prepare($row['indicatif']));
							$longitude = $db->prepare($row['longitude']);
							$latitude = $db->prepare($row['latitude']);
							$etat=$db->prepare($row['etat']);
							$iconid=$db->prepare($row['iconid']);
							$tel=$db->prepare($row['mail']);	
							$precision=$db->prepare($row['precision']);	
							$rapport=$db->prepare($row['rapport']);	
							if ($rapport=="")
							{
								$rapport=" ";
							}
                            $document_envoye=$db->prepare($row['document_envoye']);
							if ($document_envoye=="" || !isset($document_envoye) || empty($document_envoye))
							{
								$document_envoye=" ";
							}
							$resultat.=$code."><".$statut."><".$nom."><".$prenom."><".$indicatif."><".$longitude."><".$latitude."><".$etat."><".$iconid."><".$tel."><".$precision."><".$rapport."><".$document_envoye."\n";
						}
					}
}

if ($result && $result->num_rows>0) 
{
	$resultat = substr($resultat, 0, -1);  
	
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] SUCCESS - " . $result->num_rows . " membre(s) trouvé(s)\n", FILE_APPEND);
	
	ob_clean();
	echo "return_txt=$resultat";
    
     $sql = "UPDATE `REZO` SET `document_envoye`='' WHERE moncode IN ('$mon_array_code');";
     $result =$db->query($sql);
    
}else
{
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [info_activite] ERROR - Aucun membre trouvé pour les codes: " . substr($mon_array_code, 0, 200) . "\n", FILE_APPEND);
	ob_clean();
	echo "return_txt=-1"; 
}


?>