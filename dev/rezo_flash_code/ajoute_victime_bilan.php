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

$code=$_POST['code'];
$id_activite=addslashes($_POST['id_activite']);
$id_mission=addslashes($_POST['id_mission']);
$nom=addslashes($_POST['nom']);
$prenom=addslashes($_POST['prenom']);
$identification=addslashes($_POST['identification']);
$date_naissance=$_POST['date_naissance'];
if ($date_naissance!=''){
    $date_naissance = strtotime(str_replace('/', '-', $date_naissance));
    $date_naissance = date('Y-m-d', $date_naissance);
}

$age=addslashes($_POST['age']);
$sexe=$_POST['sexe'];
$nationalite=addslashes($_POST['nationalite']);
$adresse=addslashes($_POST['adresse']);
$commentaire=addslashes($_POST['commentaire']);
$json_horaires=$_POST['json_horaires'];
$bilan_circonstanciel=addslashes($_POST['bilan_circonstanciel']);
$intervention_victime=addslashes($_POST['intervention_victime']);
$centre_accueil=addslashes($_POST['centre_accueil']);



$sql = "INSERT INTO `REZO_FLASH_LISTE_VICTIME` (code,id_activite,id_mission,nom,prenom,identification,date_naissance,age,sexe,nationalite,adresse,commentaire,json_horaires,bilan_circonstanciel,intervention_victime,centre_accueil)
				VALUES ('$code',
					'$id_activite', 
					'$id_mission',
					'$nom',
					'$prenom',
					'$identification',
					'$date_naissance',
					'$age',
					'$sexe',
					'$nationalite',
                    '$adresse',
                    '$commentaire',
                    '$json_horaires',
                    '$bilan_circonstanciel',
                    '$intervention_victime',
                    '$centre_accueil'
				) ;";


$result = $db->query($sql);		

echo "return_txt=1";



?>