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

$mon_code=$_POST['liste_des_codes'];
$mon_array_code=substr($mon_code, 0, -1);  
$mon_array_code=explode(",",$mon_array_code);
$mon_array_code=implode("','",$mon_array_code);


$resultat="";					
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO` WHERE moncode IN ('$mon_array_code');"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$code = $db->prepare($row['moncode']);
							$nom = stripcslashes($db->prepare($row['nom']));
							$prenom = stripcslashes($db->prepare($row['prenom']));
							$indicatif = stripcslashes($db->prepare($row['indicatif']));
							
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