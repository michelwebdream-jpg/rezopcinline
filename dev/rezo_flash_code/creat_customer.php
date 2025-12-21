<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');



# fonction permettant l'encodage des caractres accentuŽs
function getFormatedText($texte){ 
$texte =addslashes($texte);
return $texte; 
} 
/**************************************************************************/
function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
}
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

$resp="2";

if ($myArrayReponse['license']=="invalid"){
		$resp="3";		
}
if ($myArrayReponse['license']=="valid"){
	if ($myArrayReponse['customer_email']==$mail){
		$resp="4";		
	}else{
		$resp="2";		
	}

}
if ($myArrayReponse['license']=="inactive"){
	if ($myArrayReponse['customer_email']==$mail){
		$resp="0";		
	}else{
		$resp="2";		
	}					
}
if ($myArrayReponse['license']=="expired"){
	if ($myArrayReponse['customer_email']==$mail){
		$resp="5";		
	}else{
		$resp="2";		
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
/**************************************************************************/
function activate_licence($licence){
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://www.web-dream.fr/?edd_action=activate_license&item_name=cle-de-licence-rezo-pc-inline-1-an&license='.$licence.'&url=http://www.web-dream.fr'//,
    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$myArrayReponse = json_decode($resp, true);
if ($myArrayReponse['success']=="true"){
	return true;
}else{
	return false;
	
}
}
/**************************************************************************/

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO IN CLASS FILE )
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

$mon_nom=getFormatedText($_POST['mon_nom']);
$mon_prenom=getFormatedText($_POST['mon_prenom']);
$mon_telephone=getFormatedText($_POST['mon_telephone']);
$mon_mail=getFormatedText($_POST['mon_mail']);
$mon_iconid=$_POST['mon_iconid'];
$mon_indicatif=getFormatedText($_POST['mon_indicatif']);
$mon_etat=getFormatedText($_POST['mon_etat']);
$mon_password=getFormatedText($_POST['mon_password']);
$ma_licence=getFormatedText($_POST['ma_licence']);

if(isset($_POST['size_limit'])){
    $size_limit=intval($_POST['size_limit']);
}else{
    $size_limit=0;
}
if(isset($_POST['appli_type_PC'])){
    $appli_type_PC=intval($_POST['appli_type_PC']);
}else{
    $appli_type_PC=-1;
}

$mon_code=unique_id(8);

// Vérification du nombre d'utilisation de l'adresse mail
$sql = "SELECT * FROM `REZO` WHERE moncode = '$mon_code';"; 
$result = $db->query($sql);

if ($result->num_rows>0) 
{
	echo "return_txt=6";
	return;
}

$sql = "SELECT * FROM `REZO_FLASH` WHERE mail = '$mon_mail';"; 
$result = $db->query($sql);

if ($result->num_rows>0) 
{
	echo "return_txt=1";
	return;
}

$resultat_du_test=test_licence($ma_licence,$mon_mail);

if ($resultat_du_test!="0"){
	echo "return_txt=$resultat_du_test";
	return;
}else{
	
	if (activate_licence($ma_licence)){
	
		$expiration_license=get_date_licence($ma_licence,$mon_mail);
		
		$sql = "INSERT INTO `REZO`
						VALUES (
							'$mon_code',
							'$mon_nom', 
							'$mon_prenom', 
							'$mon_telephone', 
							'0.0',
							'0.0',
							'0.0',
							'0',
							'inactif',
							'$mon_iconid',
							'$mon_indicatif',
							'$mon_etat',
							'',
							NOW(),
							NOW(),
							'',
							'',
							NOW(),
                            '$size_limit',
                            '$appli_type_PC',
                            ''
						) ;";
		
		
		
		$result = $db->query($sql);		
		
		$sql = "INSERT INTO `REZO_FLASH` 
						VALUES (
							'$mon_code',
							'$mon_mail', 
							'$mon_password', 
							NOW(), 
							'$ma_licence',
							'".$expiration_license."',
							'1',
							'1',
							'1'
						) ;";
		
		
		
		$result = $db->query($sql);	
		
		$sql = "SELECT * FROM `REZO_FLASH` WHERE moncode = '$mon_code';"; 
		if($result = $db->query($sql))
		{
			if($result->num_rows){
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					$date_fin_validite_licence = $db->prepare($row['date_fin_validite_licence']);
				}
			}
		}
		$date=date_create($date_fin_validite_licence);
		$date_fin_validite_licence=date_format($date, 'd/m/Y H:i:s');
		echo "return_txt=ok$mon_code$date_fin_validite_licence";
        
        if ($appli_type_PC>0 && !file_exists('../rezo_galerie/'.$mon_code)) {
            mkdir('../rezo_galerie/'.$mon_code, 0777, true);
        }
        
	}else{
		echo "return_txt=-1"; 
	}
}
?>