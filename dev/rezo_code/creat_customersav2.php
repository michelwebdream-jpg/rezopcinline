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
function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
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

$mon_nom=getFormatedText($_POST['mon_nom']);
$mon_prenom=getFormatedText($_POST['mon_prenom']);
$mon_mail=getFormatedText($_POST['mon_mail']);
$mon_iconid=$_POST['mon_iconid'];
$mon_indicatif=getFormatedText($_POST['mon_indicatif']);
$mon_etat=getFormatedText($_POST['mon_etat']);

$mon_code=unique_id(8);

// Vérification du nombre d'utilisation de l'adresse mail
$sql = "SELECT * FROM `REZO` WHERE moncode = '$mon_code';"; 
$result = $db->query($sql);

if ($result->num_rows>0) 
{
	echo "-1";
	return;
}

$sql = "INSERT INTO `REZO` 
				VALUES (
					'$mon_code',
					'$mon_nom', 
					'$mon_prenom', 
					'$mon_mail', 
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
					NOW()
				) ;";



$result = $db->query($sql);		

echo "ok-".$mon_code;

?>