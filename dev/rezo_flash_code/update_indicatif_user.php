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

// Désactiver l'affichage des erreurs AVANT toute autre chose
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Démarrer le buffer de sortie pour capturer toute sortie non désirée
ob_start();

header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

# fonction permettant l'encodage des caractres accentuŽs
function getFormatedText($texte){ 
	$texte =addslashes($texte);
return $texte; 
} 

// Récupération des variables transmise par l'animation
$code_utilisateur_a_modifier=$_POST['code_utilisateur_a_modifier'];
$nouveau_indicatif=getFormatedText($_POST['nouveau_indicatif']);

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
// Utiliser spl_autoload_register au lieu de __autoload (déprécié)
if(!function_exists("autoload_dbconnect")){ 
	function autoload_dbconnect($class_name){
		$file = 'classes/class_'.$class_name.'.php';
		if (file_exists($file)) {
			require_once($file);
		}
	}
	spl_autoload_register('autoload_dbconnect');
}

// Définir le fichier de log (chemin relatif depuis ce fichier)
$log_file = dirname(dirname(dirname(__FILE__))) . '/application/logs/db_debug.log';

// Détecter si on est en local
$is_local = false;
$hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$local_indicators = array('localhost', '127.0.0.1', '::1', 'local', '.local', '.dev');
foreach ($local_indicators as $indicator) {
	if (stripos($hostname, $indicator) !== false) {
		$is_local = true;
		break;
	}
}
if (!$is_local && filter_var($hostname, FILTER_VALIDATE_IP) !== false) {
	$is_local = true;
}

// Si on est en local, faire une requête cURL vers le serveur de production
if ($is_local) {
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [update_indicatif_user] Mode LOCAL détecté - Proxy vers serveur PRODUCTION\n", FILE_APPEND);
	
	// Préparer les données POST
	$postData = '';
	foreach ($_POST as $k => $v) {
		$postData .= $k . '=' . urlencode($v) . '&';
	}
	$postData = rtrim($postData, '&');
	
	// Faire une requête cURL vers le serveur de production
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.web-dream.fr/dev/rezo_flash_code/update_indicatif_user.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	
	$output = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	if (curl_errno($ch)) {
		$error = curl_error($ch);
		file_put_contents($log_file, date('Y-m-d H:i:s') . " - [update_indicatif_user] ERREUR cURL: " . $error . "\n", FILE_APPEND);
		curl_close($ch);
		ob_clean();
		echo "return_txt=error";
		exit;
	}
	
	curl_close($ch);
	
	if ($httpCode >= 400) {
		file_put_contents($log_file, date('Y-m-d H:i:s') . " - [update_indicatif_user] ERREUR HTTP: " . $httpCode . "\n", FILE_APPEND);
		ob_clean();
		echo "return_txt=error";
		exit;
	}
	
	file_put_contents($log_file, date('Y-m-d H:i:s') . " - [update_indicatif_user] Réponse du serveur production reçue (HTTP $httpCode)\n", FILE_APPEND);
	ob_clean();
	echo $output;
	exit;
}

// Si on est en production, utiliser la connexion locale normale
// CREATE DATABASE OBJECT
$db = new DbConnect();
$db->show_errors();
$db->query("SET NAMES 'utf8'");

//Create INSERT query
$sql = "UPDATE `REZO` SET `indicatif`='{$nouveau_indicatif}' WHERE `moncode`='{$code_utilisateur_a_modifier}';";

$db->query($sql);

ob_clean(); // Nettoyer le buffer avant d'afficher
echo "return_txt=ok";


?>