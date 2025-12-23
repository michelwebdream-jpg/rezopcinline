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

/**************************************************************************/
function test_licence($licence,$mail){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://www.web-dream.fr/?edd_action=check_license&item_name=cle-de-licence-rezo-pc-inline-1-an&license='.$licence.'&url=http://www.web-dream.fr'//,
));
$resp = curl_exec($curl);
curl_close($curl);

$myArrayReponse = json_decode($resp, true);

$resp="0";
if ($myArrayReponse['license']=="invalid"){
		$resp="0";		
}
if ($myArrayReponse['license']=="valid"){
	if ($myArrayReponse['customer_email']==$mail){
		$resp="1";		
	}else{
		$resp="0";		
	}

}
if ($myArrayReponse['license']=="inactive"){
	if ($myArrayReponse['customer_email']==$mail){
		$resp="0";		
	}else{
		$resp="0";		
	}					
}
if ($myArrayReponse['license']=="expired"){
	if ($myArrayReponse['customer_email']==$mail){
		$resp="-1";		
	}else{
		$resp="0";		
	}					
}
return $resp;	
}
/**************************************************************************/
function get_date_licence($licence,$mail){
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://www.web-dream.fr/?edd_action=check_license&item_name=cle-de-licence-rezo-pc-inline-1-an&license='.$licence.'&url=http://www.web-dream.fr'//,
    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$myArrayReponse = json_decode($resp, true);
return $myArrayReponse['expires'];
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

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO IN CLASS FILE )
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

$mon_code=$_POST['mon_code'];

// Recherche des mail actif ou inactif
$sql = "SELECT * FROM `REZO_FLASH` WHERE moncode='$mon_code'"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$license = $db->prepare($row['licence']);
							$mail = $db->prepare($row['mail']);
						}
					}
}

$resp=test_licence($license,$mail);

	if ($resp=="1"){
		$expiration_license=get_date_licence($license,$mail);
		
		// Nettoyer la valeur reçue (supprimer les espaces, convertir en minuscules pour la comparaison)
		$expiration_license_clean = trim(strtolower($expiration_license));
		
		// Si la licence est à vie ('lifetime'), convertir en date très lointaine
		if ($expiration_license_clean == 'lifetime' || empty($expiration_license_clean) || $expiration_license_clean == 'null' || $expiration_license_clean == 'none') {
			$expiration_license = '9999-12-31 23:59:59';
		} else {
			// S'assurer que la date est au format MySQL (YYYY-MM-DD HH:MM:SS)
			// Si c'est déjà au bon format, l'utiliser tel quel
			// Sinon, essayer de la convertir
			$date_obj = date_create($expiration_license);
			if ($date_obj !== false) {
				$expiration_license = date_format($date_obj, 'Y-m-d H:i:s');
			} else {
				// Si la conversion échoue, utiliser une date par défaut
				$expiration_license = '9999-12-31 23:59:59';
			}
		}
		
		// Échapper la valeur pour éviter les injections SQL
		$db_connection = $db->Connection(); // Obtenir l'instance mysqli
		$expiration_license_escaped = $db_connection->real_escape_string($expiration_license);
		$mon_code_escaped = $db_connection->real_escape_string($mon_code);
		
		$sql = "UPDATE `REZO_FLASH` SET `date_fin_validite_licence`='".$expiration_license_escaped."' WHERE `moncode`='{$mon_code_escaped}';";
		$result = $db->query($sql);
		
		if (!$result) {
			$error = $db_connection->error;
			// Log l'erreur mais continue quand même
			error_log("Erreur SQL dans test_licence_administrateur: " . $error);
		}
		
		$date=date_create($expiration_license);
		$date_fin_validite_licence=date_format($date, 'd/m/Y H:i:s');
		
		ob_clean(); // Nettoyer le buffer avant d'afficher
		echo "return_txt=ok$mon_code$date_fin_validite_licence";
		
		//echo "return_txt=1";
	
	}else if ($resp=="-1"){
		ob_clean();
		echo "return_txt=-2"; 	
	}else
	{
		ob_clean();
		echo "return_txt=-1"; 	
	}
	
?>