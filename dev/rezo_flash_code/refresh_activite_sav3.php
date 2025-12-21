<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

function getFormatedText($texte){ 
//$texte =utf8_encode($texte); 
$texte =preg_replace('#(\\r|\\r\\n|\\n)#', '<br>', $texte);
    
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


$resultat="";					
// Recherche de l'adresse mail
$sql = "SELECT * FROM `REZO_FLASH_ACTIVITE` WHERE code = '$mon_code';"; 
if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$id=$db->prepare($row['Id']);
							$qte = $db->prepare($row['qte']);
							$nom_activite= stripcslashes($db->prepare($row['nom_activite']));
							$membres = $db->prepare($row['membres']);
							$date_creation = $db->prepare($row['date_creation']);
                            $phpdate = strtotime( $date_creation );
							$date_creation = date( 'd-m-Y H:i:s', $phpdate );
                            $nom_responsable=stripcslashes($db->prepare($row['nom_responsable']));
                            $adresse=getFormatedText(stripcslashes($db->prepare($row['adresse'])));
                            $nature_activite=getFormatedText(stripcslashes($db->prepare($row['nature_activite'])));
                            $remarque=getFormatedText(stripcslashes($db->prepare($row['remarque'])));
							$resultat.=$qte."><".$nom_activite."><".$membres."><".$date_creation."><".$id."><".$nom_responsable."><".$adresse."><".$remarque."><".$nature_activite."\n";
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