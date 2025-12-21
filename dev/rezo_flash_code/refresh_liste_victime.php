<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

# fonction permettant l'encodage des caractres accentuŽs
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
$id_activite_mission=intval($_POST['id_activite_mission']);
$activite_mission=$_POST['activite_mission'];


$resultat="";					

if ($activite_mission=='activite'){
    
    $sql = "SELECT * FROM `REZO_FLASH_LISTE_VICTIME` WHERE code = '$mon_code' AND id_activite=$id_activite_mission;"; 
    
}else if ($activite_mission=='mission'){
    
    $sql = "SELECT * FROM `REZO_FLASH_LISTE_VICTIME` WHERE code = '$mon_code' AND id_mission=$id_activite_mission;"; 

}else{
    echo "return_txt=-1"; 
    return;
}



if($result = $db->query($sql))
{
					if($result->num_rows){
						while($row = $result->fetch_array(MYSQLI_ASSOC)){
							$id=$db->prepare($row['id']);
							$nom= stripcslashes($db->prepare($row['nom']));
							$prenom= stripcslashes($db->prepare($row['prenom']));
                            
                            $identification= stripcslashes($db->prepare($row['identification']));
                            $date_naissance= stripcslashes($db->prepare($row['date_naissance']));
                            $phpdate = strtotime( $date_naissance );
							$date_naissance = date( 'd/m/Y', $phpdate );
                            
                            $age= stripcslashes($db->prepare($row['age']));
                            $sexe= stripcslashes($db->prepare($row['sexe']));
                            $nationalite= stripcslashes($db->prepare($row['nationalite']));
                            $adresse= getFormatedText(stripcslashes($db->prepare($row['adresse'])));
                            $commentaire= getFormatedText(stripcslashes($db->prepare($row['commentaire'])));
                            $json_horaires=stripcslashes($db->prepare($row['json_horaires']));
                            $bilan_circonstanciel= getFormatedText(stripcslashes($db->prepare($row['bilan_circonstanciel'])));
                            $type_intervention= getFormatedText(stripcslashes($db->prepare($row['intervention_victime'])));
                            $centre_accueil= getFormatedText(stripcslashes($db->prepare($row['centre_accueil'])));

							$date_creation = $db->prepare($row['date_de_saisie']);
                            $phpdate = strtotime( $date_creation );
							$date_creation = date( 'd-m-Y H:i:s', $phpdate );
							$resultat.=$id.">rezopcinline_wd<".$nom.">rezopcinline_wd<".$prenom.">rezopcinline_wd<".$identification.">rezopcinline_wd<".$date_naissance.">rezopcinline_wd<".$age.">rezopcinline_wd<".$sexe.">rezopcinline_wd<".$nationalite.">rezopcinline_wd<".$adresse.">rezopcinline_wd<".$commentaire.">rezopcinline_wd<".$json_horaires.">rezopcinline_wd<".$bilan_circonstanciel.">rezopcinline_wd<".$type_intervention.">rezopcinline_wd<".$centre_accueil.">rezopcinline_wd<".$date_creation."\n";
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