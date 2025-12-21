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

if(isset($_POST['code_PC']) && isset($_POST['size_limit_galerie']) && isset($_POST['appli_type_PC'])){

    
    $mon_code=$_POST['code_PC'];
    $size_limit_galery=$_POST['size_limit_galerie'];
    $appli_type_PC=$_POST['appli_type_PC'];
        
    $sql = "SELECT * FROM `REZO` WHERE moncode = '$mon_code';"; 
    $result = $db->query($sql);

    if ($result->num_rows>0) 
    {

        $sql = "UPDATE `REZO` SET `size_limit_galery`='{$size_limit_galery}',`appli_type_PC`='{$appli_type_PC}' WHERE `moncode`='{$mon_code}';";

        $db->query($sql);

        if ($appli_type_PC>0 && !file_exists('../rezo_galerie/'.$mon_code)) {
            mkdir('../rezo_galerie/'.$mon_code, 0777, true);
        }

        echo "return_txt=1";

                
    }else{
        echo "return_txt=-1";
    }
        
}else{
    echo "return_txt=-2";
}
?>