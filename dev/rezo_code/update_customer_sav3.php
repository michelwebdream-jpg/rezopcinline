<?PHP
#################################################################################
## Developed by Manifest Interactive, LLC                                      ##
## http://www.manifestinteractive.com                                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
##                                                                             ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY           ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE         ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR          ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE          ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        ##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR             ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE        ##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,           ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Schmalfeldt                                           ##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 */

/**
 * Begin Document
 */

header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

# fonction permettant l'encodage des caractres accentuŽs
function getFormatedText($texte){ 
//$texte =utf8_encode($texte);
$texte = str_replace('"',"'",$texte);
$texte =str_replace( "\r", "\n", $texte); 
$texte =str_replace( "<br>","\n", $texte);
$texte =str_replace( "'","''", $texte);
$texte =stripcslashes($texte); 
//$texte =str_replace( "'", "\'", $texte); 
//$texte =mysql_real_escape_string($texte); 
//$texte =addslashes($texte);
return $texte; 
} 

// Récupération des variables transmise par l'animation
$mon_code=getFormatedText($_POST['mon_code']);
//$mon_mail='m@m.com';
$latitude= floatval($_POST['latitude']);
$longitude=floatval($_POST['longitude']);
$altitude=floatval($_POST['altitude']);
$precision=floatval($_POST['precision']);
$etat=floatval($_POST['etat']);






$rapport="";
if( isset($_POST['rapport']) )
{
	$rapport=getFormatedText($_POST['rapport']);
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

//Create INSERT query
$sql = "UPDATE `REZO` SET `longitude`='{$longitude}',`latitude`='{$latitude}',`altitude`='{$altitude}',`precision`='{$precision}',`statut`='actif',`etat`='{$etat}',`rapport`='{$rapport}',`derniere_inscription`=NOW()  WHERE `moncode`='{$mon_code}';";

$result = $db->query($sql);

$sql = "SELECT * FROM `REZO_FLASH_MISSION` WHERE INSTR(`membres`, '$mon_code') > 0 AND INSTR(`membres_lu_mission`, '$mon_code') = 0 AND `etat_mission`=1;";
$resultat="";
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
							
							$phpdate = strtotime( $date_lancement );
							$date_lancement = date( 'd-m-Y H:i:s', $phpdate );
							
							$qte = $db->prepare($row['qte']);
							
							
							/*$date_cloture= $db->prepare($row['date_cloture']);
							
							$phpdate = strtotime( $date_cloture );
							$date_cloture = date( 'd-m-Y H:i:s', $phpdate );
							
							$membres = $db->prepare($row['membres']);
							
							$membres_lu_mission = $db->prepare($row['membres_lu_mission']);
							
							$date_creation = $db->prepare($row['date_creation']);
							
							$phpdate = strtotime( $date_creation );
							$date_creation = date( 'd-m-Y H:i:s', $phpdate );*/
							
							$resultat.=$qte."><".$nom_de_la_mission."><".$adresse_mission."><".$lien_googlemap_mission."><".$message_mission."><".$etat_mission."><".$date_lancement."><".$id."\n";
						}
					}
}
if ($resultat!="")
{
	echo "WB_Mission_: ".$resultat;
}else{
	echo "ok";
}


?>