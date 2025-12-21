<?PHP


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
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
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
		
		$sql = "UPDATE `REZO_FLASH` SET `date_fin_validite_licence`='".$expiration_license."' WHERE `moncode`='{$mon_code}';";
		$db->query($sql);
		
		$date=date_create($expiration_license);
		$date_fin_validite_licence=date_format($date, 'd/m/Y H:i:s');
		echo "return_txt=ok$mon_code$date_fin_validite_licence";
		
		//echo "return_txt=1";
	
	}else if ($resp=="-1"){
		echo "return_txt=-2"; 	
	}else
	{
		echo "return_txt=-1"; 	
	}
	
?>