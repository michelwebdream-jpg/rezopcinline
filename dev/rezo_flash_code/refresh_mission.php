<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

# fonction permettant l'encodage des caractres accentuŽs
function getFormatedText($texte){ 
//$texte =utf8_encode($texte); 
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

$mon_code=$_POST['mon_code'];

// Recherche des mail actif ou inactif
$sql = "SELECT * FROM `REZO_FLASH_MISSION` WHERE code= '$mon_code';"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$validite_mission=$db->prepare($row['validite_mission']);
							
							$date_lancement = $db->prepare($row['date_lancement']);
							$id =$db->prepare($row['Id']);
							$ts = strtotime($date_lancement);
							if ($ts<(time()-60*60*(int)$validite_mission))
							{
								$sql = "UPDATE `REZO_FLASH_MISSION` SET `etat_mission`=0 WHERE `Id`='$id';";
								$db->query($sql);
							}
						}
					}
}

$resultat="";					
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO_FLASH_MISSION` WHERE code = '$mon_code';"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){

							$id=$db->prepare($row['Id']);
							
							$nom_de_la_mission= $db->prepare($row['nom_mission']);
							$adresse_mission= $db->prepare($row['adresse_mission']);
							$lien_googlemap_mission= $db->prepare($row['lien_googlemap_mission']);
							$message_mission= getFormatedText($db->prepare($row['message_mission']));
							$etat_mission= $db->prepare($row['etat_mission']);
							$date_lancement= $db->prepare($row['date_lancement']);
							$validite_mission=$db->prepare($row['validite_mission']);
							
							$phpdate = strtotime( $date_lancement );
							$date_lancement = date( 'd-m-Y H:i:s', $phpdate );
							
							$date_cloture= $db->prepare($row['date_cloture']);
							
							$phpdate = strtotime( $date_cloture );
							$date_cloture = date( 'd-m-Y H:i:s', $phpdate );
							
							$qte = $db->prepare($row['qte']);
							$membres = $db->prepare($row['membres']);
							
							$membres_lu_mission = $db->prepare($row['membres_lu_mission']);
							$membres_refus_mission = $db->prepare($row['membres_refus_mission']);
							$membres_fini_mission = $db->prepare($row['membres_fini_mission']);
							
							$date_creation = $db->prepare($row['date_creation']);
							
							$phpdate = strtotime( $date_creation );
							$date_creation = date( 'd-m-Y H:i:s', $phpdate );
							
							$resultat.=$qte."><".$nom_de_la_mission."><".$adresse_mission."><".$lien_googlemap_mission."><".$message_mission."><".$etat_mission."><".$date_lancement."><".$date_cloture."><".$membres."><".$date_creation."><".$membres_lu_mission."><".$membres_refus_mission."><".$membres_fini_mission."><".$validite_mission."><".$id."\n";
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