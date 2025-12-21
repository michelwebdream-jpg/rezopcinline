<?PHP


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
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO IN CLASS FILE )
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

$mon_code_perso=$_POST['mon_code'];
$membres=$_POST['codes_dans_la_mission'];
$nom_de_la_mission=addslashes($_POST['nom_de_la_mission']);
$adresse_mission=addslashes($_POST['adresse_mission']);
$lien_googlemap_mission=addslashes($_POST['lien_googlemap_mission']);
$message_mission=addslashes($_POST['message_mission']);
$qte=$_POST['qte'];
$validite_mission=$_POST['validite_mission'];
$Id=$_POST['Id'];



$sql = "UPDATE `REZO_FLASH_MISSION` SET `code`='{$mon_code_perso}',`nom_mission`='{$nom_de_la_mission}',`adresse_mission`='{$adresse_mission}',`lien_googlemap_mission`='{$lien_googlemap_mission}',`message_mission`='{$message_mission}',`membres`='{$membres}',`qte`='{$qte}',`validite_mission`='{$validite_mission}',`date_creation`=NOW() WHERE `Id`='{$Id}';";

$result = $db->query($sql);		

echo "return_txt=1";



?>