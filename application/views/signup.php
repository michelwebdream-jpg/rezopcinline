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
    
	<h1 style="margin-bottom:0px;"><?php echo $heading;?></h1>
<p style="font-size:10px;text-align:center;"><?php echo version_du_soft?></p>
    
        
	<div id="container_formulaire">

        <div id="formulaire">
        
            <p style="font-size:18px;text-align:center;";>Créer un compte.</p>
            <p style="text-align:center;">
    
        Veuillez remplir tous les champs ci-dessous pour créer votre compte REZO+ PC Inline.<br />Une clé de licence valide est nécessaire.<br />Si vous n'en possédez pas, vos pouvez en acquérir une à l'adresse suivante:<br /><br /><a href="http://www.web-dream.fr/app/downloads/cle-de-licence-rezo-pc-inline-1-an/" target="_blank">http://www.web-dream.fr/app/downloads/cle-de-licence-rezo-pc-inline-1-an/</a>
    </p>
            <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
            <?php endif;?>
            <hr/><div style="height:15px;font-size:12px;"><i>Tous les champs sont obligatoires.</i></div>
            
            <?php echo form_open('signup');?>

                <label for="text_input_mon_nom">Mon nom</label>
                <input type="text" name="text_input_mon_nom" value="<?php echo set_value('text_input_mon_nom');?>"/>
                <?php echo form_error('text_input_mon_nom','<div class="error">','</div>');?>

                <label for="text_input_mon_prenom">Mon prénom</label>
                <input type="text" name="text_input_mon_prenom" value="<?php echo set_value('text_input_mon_prenom');?>"/>
                <?php echo form_error('text_input_mon_prenom','<div class="error">','</div>');?>
            
                <label for="text_input_mon_telephone">Mon téléphone</label>
                <input type="text" name="text_input_mon_telephone" value="<?php echo set_value('text_input_mon_telephone');?>"/>
                <?php echo form_error('text_input_mon_telephone','<div class="error">','</div>');?>
            
                <label for="text_input_mon_mail">Mon e-mail (doit être identique à l'adresse fournie lors de l'achat de la clé de licence)</label>
                <input type="text" name="text_input_mon_mail" value="<?php echo set_value('text_input_mon_mail');?>"/>
                <?php echo form_error('text_input_mon_mail','<div class="error">','</div>');?>
            
                <label for="text_input_mon_mail2">Confirmer votre e-mail</label>
                <input type="text" name="text_input_mon_mail2" value="<?php echo set_value('text_input_mon_mail2');?>"/>
                <?php echo form_error('text_input_mon_mail2','<div class="error">','</div>');?>  
            
                <label for="text_input_mon_indicatif">Mon indicatif</label>
                <input type="text" name="text_input_mon_indicatif" value="<?php echo set_value('text_input_mon_indicatif');?>"/>
                <?php echo form_error('text_input_mon_indicatif','<div class="error">','</div>');?>
            
                <label for="text_input_mon_password1">Mon mot de passe</label>
                <input type="password" name="text_input_mon_password1" value="<?php echo set_value('text_input_mon_password1');?>"/>
                <?php echo form_error('text_input_mon_password1','<div class="error">','</div>');?>
            
                <label for="text_input_mon_password2">Confirmer le mot de passe</label>
                <input type="password" name="text_input_mon_password2" value="<?php echo set_value('text_input_mon_password2');?>"/>
                <?php echo form_error('text_input_mon_password2','<div class="error">','</div>');?>
            
                <label for="text_input_cle_de_licence">Ma clé de licence</label>
                <input type="text" name="text_input_cle_de_licence" value="<?php echo set_value('text_input_cle_de_licence');?>"/>
                <?php echo form_error('text_input_cle_de_licence','<div class="error">','</div>');?>
            
                <label for="marker">Mon icône</label>
                <table width="100%" border="1" align="center">
                  <tr align="center">
                    <td><input type="radio" id="marker_user_1" name="marker" value="1" checked="checked"/><img src="<?php echo base_url();?>images/marker_user_1.png" /></td>
                    <td><input type="radio" id="marker_user_2" name="marker" value="2" /><img src="<?php echo base_url();?>images/marker_user_2.png" /></td>
                    <td><input type="radio" id="marker_user_3" name="marker" value="3" /><img src="<?php echo base_url();?>images/marker_user_3.png" /></td>
                    <td><input type="radio" id="marker_user_4" name="marker" value="4" /><img src="<?php echo base_url();?>images/marker_user_4.png" /></td>
                    <td><input type="radio" id="marker_user_5" name="marker" value="5" /><img src="<?php echo base_url();?>images/marker_user_5.png" /></td>
                  </tr>
                  <tr align="center">
                    <td><input type="radio" id="marker_user_6" name="marker" value="6" /><img src="<?php echo base_url();?>images/marker_user_6.png" /></td>
                    <td><input type="radio" id="marker_user_7" name="marker" value="7" /><img src="<?php echo base_url();?>images/marker_user_7.png" /></td>
                    <td><input type="radio" id="marker_user_8" name="marker" value="8" /><img src="<?php echo base_url();?>images/marker_user_8.png" /></td>
                    <td><input type="radio" id="marker_user_9" name="marker" value="9" /><img src="<?php echo base_url();?>images/marker_user_9.png" /></td>
                    <td><input type="radio" id="marker_user_10" name="marker" value="10" /><img src="<?php echo base_url();?>images/marker_user_10.png" /></td>
                  </tr>
                  <tr align="center">
                    <td><input type="radio" id="marker_user_11" name="marker" value="11" /><img src="<?php echo base_url();?>images/marker_user_11.png" /></td>
                    <td><input type="radio" id="marker_user_12" name="marker" value="12" /><img src="<?php echo base_url();?>images/marker_user_12.png" /></td>
                    <td><input type="radio" id="marker_user_13" name="marker" value="13" /><img src="<?php echo base_url();?>images/marker_user_13.png" /></td>
                    <td><input type="radio" id="marker_user_14" name="marker" value="14" /><img src="<?php echo base_url();?>images/marker_user_14.png" /></td>
                    <td><input type="radio" id="marker_user_15" name="marker" value="15" /><img src="<?php echo base_url();?>images/marker_user_15.png" /></td>
                  </tr>
                    <tr align="center">
                    <td><input type="radio" id="marker_user_16" name="marker" value="16" /><img src="<?php echo base_url();?>images/marker_user_16.png" /></td>
                    <td><input type="radio" id="marker_user_17" name="marker" value="17" /><img src="<?php echo base_url();?>images/marker_user_17.png" /></td>
                    <td><input type="radio" id="marker_user_18" name="marker" value="18" /><img src="<?php echo base_url();?>images/marker_user_18.png" /></td>
                    <td><input type="radio" id="marker_user_19" name="marker" value="19" /><img src="<?php echo base_url();?>images/marker_user_19.png" /></td>
                    <td><input type="radio" id="marker_user_20" name="marker" value="20" /><img src="<?php echo base_url();?>images/marker_user_20.png" /></td>
                  </tr>
                    <tr align="center">
                    <td><input type="radio" id="marker_user_21" name="marker" value="21" /><img src="<?php echo base_url();?>images/marker_user_21.png" /></td>
                    <td><input type="radio" id="marker_user_22" name="marker" value="22" /><img src="<?php echo base_url();?>images/marker_user_22.png" /></td>
                    <td><input type="radio" id="marker_user_23" name="marker" value="23" /><img src="<?php echo base_url();?>images/marker_user_23.png" /></td>
                    <td><input type="radio" id="marker_user_24" name="marker" value="24" /><img src="<?php echo base_url();?>images/marker_user_24.png" /></td>
                    <td><input type="radio" id="marker_user_25" name="marker" value="25" /><img src="<?php echo base_url();?>images/marker_user_25.png" /></td>
                  </tr>
                    <tr align="center">
                    <td><input type="radio" id="marker_user_26" name="marker" value="26" /><img src="<?php echo base_url();?>images/marker_user_26.png" /></td>
                    <td><input type="radio" id="marker_user_27" name="marker" value="27" /><img src="<?php echo base_url();?>images/marker_user_27.png" /></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
            
                <p style="margin-top:20px;"><input id="button_submit" type="submit" value="Valider" /></p>

            <?php echo form_close();?>
            
        </div>
        <div style="height:30px;"></div>
	</div>
</div>
    
<div class="separator"></div>
    <p style="text-align:center;";><a href="<?php echo base_url();?>signup/login" class="bouton_creer_un_compte">Me connecter à REZO+ PC Inline</a></p>
    <footer>
    
        <p class="footer"><?php if(isset($footing)) echo $footing;?></p>
    
    </footer>
</body>
</html>
