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

$mon_nom="";
$mon_prenom="";

$mon_code=$_POST['mon_code'];
$mon_array_code=explode("{}",$mon_code);
$mon_array_code=implode("','",$mon_array_code);

// Recherche des mail actif ou inactif
$sql = "SELECT * FROM `REZO` WHERE moncode IN ('$mon_array_code');"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							
							$date1 = new DateTime($db->prepare($row['derniere_inscription']));
							$date2 = new DateTime('now');
							$number2 = (int)$date2->format('U');
							$number1 = (int)$date1->format('U');
							if	(($number2 - $number1)>3*60)
							{
								$code =$db->prepare($row['moncode']);
								$sql = "UPDATE `REZO` SET `statut`='inactif' WHERE `moncode`='$code';";
								$db->query($sql);
							
							}
							
							
							//$dernieredateactivee = $db->prepare($row['derniere_inscription']);
							//$code =$db->prepare($row['moncode']);
							//$ts = strtotime($dernieredateactivee);
							//if ($ts<(mktime()-250))
							//{
							//	$sql = "UPDATE `REZO` SET `statut`='inactif' WHERE `moncode`='$code';";
							//	$db->query($sql);
							//}
						}
					}
}


$statut="";

$resultat="";
					
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO` WHERE moncode IN ('$mon_array_code');"; 

if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$code=$db->prepare($row['moncode']);
							$nom=$db->prepare($row['nom']);
							$prenom=$db->prepare($row['prenom']);
							$longitude = $db->prepare($row['longitude']);
							$latitude = $db->prepare($row['latitude']);
							$altitude= $db->prepare($row['altitude']);
							$precision= $db->prepare($row['precision']);							
							$statut= $db->prepare($row['statut']);	
							$indicatif=$db->prepare($row['indicatif']);
							$iconid=$db->prepare($row['iconid']);
							$etat=$db->prepare($row['etat']);
							$telephone=$db->prepare($row['mail']);
							$rapport=" ";
							
							$resultat.=$code."><".$nom."><".$prenom."><".$longitude."><".$latitude."><".$altitude."><".$precision."><".$statut."><".$indicatif."><".$iconid."><".$etat."><".$telephone."><".$rapport."\n";
						}
					}
}

if ($result->num_rows>0) 
{
	$resultat = substr($resultat, 0, -1);  
	echo $resultat;	
	
}else
{
	echo "-1"; 
}



?>