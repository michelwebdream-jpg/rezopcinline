<?php

	if(!$_POST) exit;

	$your_email = $_POST['destinataire'];
	$email_subject = $_POST['titre'];
	$email_content = $_POST['contenu'];
		 
	$headers = 'Content-type: text/html; charset=UTF-8' . "\r\n".'From: info@web-dream.fr' . "\r\n" .
     'Reply-To: info@web-dream.fr' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

	// echo "return_txt=$your_email.$email_subject.$email_content.$headers";
	if(@mail($your_email,$email_subject,$email_content,$headers)) {
		echo "return_txt=1";
	} else {
		echo "return_txt=-1";
	}

?>