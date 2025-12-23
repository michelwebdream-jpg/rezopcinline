<?PHP

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
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [modifie_iconid_user] Mode LOCAL détecté - Proxy vers serveur PRODUCTION\n", FILE_APPEND);
	
	// Préparer les données POST
	$postData = '';
	foreach ($_POST as $k => $v) {
		$postData .= $k . '=' . urlencode($v) . '&';
	}
	$postData = rtrim($postData, '&');
	
	// Faire une requête cURL vers le serveur de production
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.web-dream.fr/dev/rezo_flash_code/modifie_iconid_user.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	
	$output = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	if (curl_errno($ch)) {
		$error = curl_error($ch);
		file_put_contents($log_file, date('Y-m-d H:i:s') . " - [modifie_iconid_user] ERREUR cURL: " . $error . "\n", FILE_APPEND);
		curl_close($ch);
		ob_clean();
		echo "-1";
		exit;
	}
	
	curl_close($ch);
	
	if ($httpCode >= 400) {
		file_put_contents($log_file, date('Y-m-d H:i:s') . " - [modifie_iconid_user] ERREUR HTTP: " . $httpCode . "\n", FILE_APPEND);
		ob_clean();
		echo "-1";
		exit;
	}
	
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [modifie_iconid_user] Réponse du serveur production reçue (HTTP $httpCode)\n", FILE_APPEND);
	ob_clean();
	echo $output;
	exit;
}

// Si on est en production, utiliser la connexion locale normale
// CREATE DATABASE OBJECT
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

$code=$_POST['code'];
$type_action=$_POST['type_action'];
$valeur=$_POST['valeur'];

$sql = "INSERT INTO `REZO_FLASH_COM_PC_VERS_USER` 
(code,type_action,valeur,date_demande)
				VALUES (
					'$code',
					'$type_action',
                    '$valeur',
					NOW()
				) ;";

if ($result = $db->query($sql)){
    ob_clean(); // Nettoyer le buffer avant d'afficher
    echo "1";
}else{
    ob_clean(); // Nettoyer le buffer avant d'afficher
    echo "-1";
}





?>