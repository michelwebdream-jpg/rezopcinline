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

$code_PC=$_POST['code_PC'];


$mes_contact='';					
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO_CONTACT` WHERE code_PC='$code_PC';"; 
if($result = $db->query($sql))
{
	if($result->num_rows){
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$mes_contact = $db->prepare($row['mes_contacts']);
		}
	}
}

$resultat='';

	
$mes_contact=rtrim($mes_contact, ",");
$mes_contact_array=explode(",",$mes_contact);
$mes_contact=implode("','",$mes_contact_array);

$sql = "SELECT * FROM `REZO` WHERE moncode IN ('$mes_contact');"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$code = $db->prepare($row['moncode']);
							$nom= $db->prepare($row['nom']);
							$prenom=$db->prepare($row['prenom']);
							$indicatif = $db->prepare($row['indicatif']);
						
							$resultat.=$code."><".$nom."><".$prenom."><".$indicatif."\n";
						}
					}
}


if ($result->num_rows>0) 
{
	$resultat = substr($resultat, 0, -1);  
	
	echo "return_txt=$resultat";
}else
{
	echo "return_txt=-1"; 
}


?>