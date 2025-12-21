<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css"/>
    
    <script src="<?php echo base_url();?>js/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/sweetalert.css">
    
	<title><?php echo $titre;?></title>
    <script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-19724464-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
    </script>

</head>
<body>

<div id="container">
    <p style="text-align:center;">
    <a href="<?php echo base_url();?>"><img border="0" alt="Rezo+ pc inline" src="<?php echo base_url();?>images/icone_final_rezo_plus_PC_inline128.png" width="100" height="100"></a>
    </p>
    
	
    <p style="font-size:10px;text-align:center;"><?php echo version_du_soft?></p>
    
        
	<div id="container_formulaire">

        <div id="formulaire">
        
            <p style="font-size:18px;text-align:center;";>Code et mot de passe oubliés.</p>
            <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
            <?php endif;?>
            <?php if(isset($succes)):?>
            <script>swal({   title: "Succès.",   text: "Votre code et mot de passe ont bien étés envoyés à votre adresse email !",   type: "success",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "", closeOnConfirm: true }, function(){   
                window.location = "index.php";   
        });</script>
            <div class="succes"><?php echo $succes;?></div>
            <?php endif;?>
            
            <p style="text-align:center;">Pour recevoir votre code et votre mot de passe à REZO+ PC Inline, veuillez saisir votre adresse email dans le champ ci-dessous.</p>
            <hr/>
            <div style="height:15px;font-size:12px;"></div>
            
            <?php echo form_open('envoi_password');?>

                <label for="text_input_mon_email">Mon adresse email.</label>
                <input type="text" name="text_input_mon_email" value=""/>
                <?php echo form_error('text_input_mon_email','<div class="error">','</div>');?>

                <p style="margin-top:20px;"><input id="button_submit" type="submit" value="Envoyer" /></p>

            <?php echo form_close();?>
            
        </div>
        <div style="height:30px;"></div>
	</div>
</div>
    
    <footer>
    
        <p class="footer"><?php if(isset($footing)) echo $footing;?></p>
    
    </footer>
</body>
</html>
