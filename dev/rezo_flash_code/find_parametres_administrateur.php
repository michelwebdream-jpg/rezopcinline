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

$mon_code=getFormatedText($_POST['mon_code']);

$db->query("SET NAMES 'utf8'");
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO_FLASH` WHERE moncode = '$mon_code';"; 
if($result = $db->query($sql))
{
	if($result->num_rows){
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$centrage_carte = $db->prepare($row['centrage_carte']);
			$type_carte = $db->prepare($row['type_carte']);
			$alerte_sonore_depart_intervention = $db->prepare($row['alerte_sonore_depart_intervention']);
		}
	}
}

if ($result->num_rows>0) 
{
	$txt=$centrage_carte."><".$type_carte."><".$alerte_sonore_depart_intervention;
	echo"return_txt=$txt";
}else
{
	echo "return_txt=-1"; 
}


?>