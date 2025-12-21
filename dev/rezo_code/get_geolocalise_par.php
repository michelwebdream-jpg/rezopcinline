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

$mon_code=$_POST['mon_code'];

$resultat="";
    
// Vérification du nombre d'utilisation de l'adresse mail
$sql = "SELECT * FROM `REZO` WHERE moncode = '$mon_code';"; 

if($result = $db->query($sql))
{
    if($result->num_rows){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){

            $date1 = new DateTime($db->prepare($row['date_geolocparpc']));
            $date2 = new DateTime('now');
            $number2 = (int)$date2->format('U');
            $number1 = (int)$date1->format('U');
            if	(($number2 - $number1)<30)
            {
                $geolocparpc=$db->prepare($row['geolocparpc']);
                $resultat=$geolocparpc;
                
                $code_pc = explode("--rezo-wd-ozer--", $geolocparpc);
                
                $plateforme=$db->prepare($row['plateforme']);
                $resultat=$resultat.'--rezo-wd-ozer--'.$plateforme;

                
            }else
            {
                echo "-1";
                return;
            }
        }
    }else
    {
        echo "-1";
        return;
    }
    
    if(count($code_pc) >0)
    {
        if ($code_pc[0]!="") 
        {
            $sql = "SELECT * FROM `REZO` WHERE moncode = '$code_pc[0]';"; 
            if($result = $db->query($sql))
            {
                if($result->num_rows){
                while($row = $result->fetch_array(MYSQLI_ASSOC)){

                    $size_limit=$db->prepare($row['size_limit_galery']);
                    $resultat=$resultat.'--rezo-wd-ozer--'.$size_limit;
                    $appli_type_PC=$db->prepare($row['appli_type_PC']);
                    $resultat=$resultat.'--rezo-wd-ozer--'.$appli_type_PC;
                    }   
                }else
                {
                    echo "-1";
                    return;
                }
            }else
            {
                echo "-1";
                return;
            }


            echo $resultat;
        }else{
            $resultat=$resultat.'--rezo-wd-ozer--';
            $resultat=$resultat.'--rezo-wd-ozer--';
            echo $resultat;
        }
    } else{
            $resultat=$resultat.'--rezo-wd-ozer--';
            $resultat=$resultat.'--rezo-wd-ozer--';
            echo $resultat;
        }
    
}else
{
	echo "-1";
}

?>