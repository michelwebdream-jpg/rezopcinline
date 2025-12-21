<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css"/>
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
        
            <p style="font-size:18px;text-align:center;";>Modifier mon mot de passe.</p>
            <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
            <?php endif;?>
            <?php if(isset($succes)):?>
            <div class="succes"><?php echo $succes;?></div>
            <?php endif;?>
            
            <p style="text-align:center;">Pour modifier votre mot de passe, veuillez saisir votre mot de passe actuel puis le nouveau.</p>
            <hr/>
            <div style="height:15px;font-size:12px;"></div>
            
            <?php echo form_open('Modification_password');?>

                <label for="text_input_mon_password_actuel">Mon mot de passe actuel.</label>
                <input type="password" name="text_input_mon_password_actuel" value=""/>
                <?php echo form_error('text_input_mon_password_actuel','<div class="error">','</div>');?>

                <label for="text_input_mon_password_new">Mon nouveau mot de passe <br/>(5 caractères minimum).</label>
                <input type="password" name="text_input_mon_password_new" value=""/>
                <?php echo form_error('text_input_mon_password_new','<div class="error">','</div>');?>
            
                <p style="margin-top:20px;"><input id="button_submit" type="submit" value="Valider" /></p>

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
