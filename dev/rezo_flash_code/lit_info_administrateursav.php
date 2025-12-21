<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

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
$mon_mot_de_passe=$_POST['mon_mot_de_passe'];

// Recherche des mail actif ou inactif
$sql = "SELECT * FROM `REZO_FLASH` WHERE moncode='$mon_code' AND motdepasse='$mon_mot_de_passe';"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$date_fin_validite_licence = $db->prepare($row['date_fin_validite_licence']);
							$today = new DateTime('');
							$expire = new DateTime(date_fin_validite_licence) //from db
							
							$mail = $db->prepare($row['moncode']);
							$date_creation= $db->prepare($row['date_creation']);
							$code= $db->prepare($row['moncode']);
							
						}
					}
}
$sql = "SELECT * FROM `REZO` WHERE moncode='$mon_code';"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							
							
							$nom = $db->prepare($row['nom']);
							$prenom= $db->prepare($row['prenom']);
							$telephone= $db->prepare($row['mail']);
							$statut= $db->prepare($row['statut']);
							$iconid= $db->prepare($row['iconid']);
							$indicatif= $db->prepare($row['indicatif']);
							$etat= $db->prepare($row['etat']);							

							
						}
					}
}
$resultat=$code."><".$nom."><".$prenom."><".$telephone."><".$mail."><".$indicatif."><".$iconid."><".$etat."><".$date_fin_validite_licence."><".$date_creation;

if($today->format("Y-m-d") < $expireDate->format("Y-m-d")) { 
	echo "return_txt=$resultat";
}else{
	echo "return_txt=-1"; 	
}
?>