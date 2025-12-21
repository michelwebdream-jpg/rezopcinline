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
$membres=$_POST['codes_dans_lactivite'];
//$mon_array_code=explode("{}",$mon_code);
//$mon_array_code=implode("','",$mon_array_code);
$nom_de_lactivite=addslashes($_POST['nom_de_lactivite']);
$qte=$_POST['qte'];

$sql = "INSERT INTO `REZO_FLASH_ACTIVITE` 
				VALUES ('DEFAULT',
					'$mon_code_perso',
					'$nom_de_lactivite', 
					'$membres',
					'$qte',
					NOW(),
					''
				) ;";


$result = $db->query($sql);		

echo "return_txt=1";



?>