<?php

$email = $_POST['email1'];
$message = $_POST['message1'];
$nom_activite_mission= $_POST['nom_activite_mission'];

$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing E-mail.
// After sanitization Validation is performed
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

$subject = 'Historique de : '.$nom_activite_mission.'.';
// To send HTML mail, the Content-type header must be set.
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
$headers .= 'From:info@web-dream.fr'."\r\n"; // Sender's Email
$template = '<div style="padding:50px; color:white;"><h2>Historique de : '.$nom_activite_mission.'</h2><br/>'
. '<br/>'. $message . '<br/><br/>'
. 'Envoyé de l\'application web REZO+ PC Inline.'
. '<br/>';
$sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";
// Message lines should not exceed 70 characters (PHP rule), so wrap it.
$sendmessage = wordwrap($sendmessage, 70);
// Send mail by PHP Mail Function.
mail($email, $subject, $sendmessage, $headers);
echo "Message envoyé.";

} else {
echo "<span>* email invalide *</span>";
}
?>