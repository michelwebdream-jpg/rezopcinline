<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

/**************************************************************************/


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

$mon_email=$_POST['mon_email'];
$pass=0;

$sql = "SELECT * FROM REZO_FLASH WHERE mail='$mon_email';"; 
if($result = $db->query($sql))
{
    if($result->num_rows){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){

            $pass=$pass+1;
            
            $code = $db->prepare($row['moncode']);
            $password = $db->prepare($row['motdepasse']);
        }
    }
}

if ($pass==1){
		
        envoi_mail($mon_email,$code,$password);
    
		echo '1';
	
}else{
	echo '-1';
}

die;

function envoi_mail($mon_email,$code,$password){
    
 
    
    
$message = 'Vous venez de faire une demande d\'identifiants de connexion à l\'interface web REZO+ PC Inline.<br/><br/>Voici votre code : '.$code.'<br/>et votre mot de passe : '.$password.'<br/><br/>Web-dream vous remercie.';

$subject = 'Identifiants REZO+ PC Inline';
// To send HTML mail, the Content-type header must be set.
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
$headers .= 'From:info@web-dream.fr'."\r\n"; // Sender's Email
$template = '<div style="padding:50px; color:white;"><h2>Identifiants REZO+ PC Inline</h2><br/>'
. '<br/>'. $message . '<br/><br/>'
. 'Envoyé de l\'application web REZO+ PC Inline.'
. '<br/>';
$sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";
// Message lines should not exceed 70 characters (PHP rule), so wrap it.
$sendmessage = wordwrap($sendmessage, 70);
// Send mail by PHP Mail Function.
mail($mon_email, $subject, $sendmessage, $headers);



}

?>