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

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("not a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
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

					
// Recherche de l'adresse mail
$sql = "DELETE FROM `REZO` WHERE moncode = '$mon_code';"; 
$result = $db->query($sql);

if (is_dir("../rezo_galerie/".$mon_code)) {
       deleteDir("../rezo_galerie/".$mon_code);
    }


echo "ok"; 


?>