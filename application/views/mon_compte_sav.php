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
        
            <p style="font-size:18px;text-align:center;";>Mon compte</p>
            <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
            <?php endif;?>
            <?php if(isset($succes)):?>
            <div class="succes"><?php echo $succes;?></div>
            <?php endif;?>
            
            <p style="text-align:center;">Vous pouvez modifier certaines informations de votre compte.</p>
            <hr/>
            <div style="height:15px;font-size:12px;"></div>
            
            <?php echo form_open('Mon_compte');?>

                <label for="text_input_mon_nom">Mon nom</label>
                <input type="text" name="text_input_mon_nom" value="<?php echo set_value('text_input_mon_nom',$utilisateur['nom_administrateur']);?>"/>
                <?php echo form_error('text_input_mon_nom','<div class="error">','</div>');?>

                <label for="text_input_mon_prenom">Mon prénom</label>
                <input type="text" name="text_input_mon_prenom" value="<?php echo set_value('text_input_mon_prenom',$utilisateur['prenom_administrateur']);?>"/>
                <?php echo form_error('text_input_mon_prenom','<div class="error">','</div>');?>
            
                <label for="text_input_mon_telephone">Mon téléphone</label>
                <input type="text" name="text_input_mon_telephone" value="<?php echo set_value('text_input_mon_telephone',$utilisateur['telephone_administrateur']);?>"/>
                <?php echo form_error('text_input_mon_telephone','<div class="error">','</div>');?>
            
                <label for="text_input_mon_mail">Mon e-mail <i style="color:#ad0a03";>(non modifiable)</i></label>
                <input type="text" name="text_input_mon_mail" value="<?php echo $utilisateur['mail_administrateur'];?>" disabled/>
            
                <label for="text_input_mon_indicatif">Mon indicatif</label>
                <input type="text" name="text_input_mon_indicatif" value="<?php echo set_value('text_input_mon_indicatif',$utilisateur['indicatif_administrateur']);?>"/>
                <?php echo form_error('text_input_mon_indicatif','<div class="error">','</div>');?>
            
                <label for="text_input_mon_code">Mon code REZO+ PC Inline  <i style="color:#ad0a03";>(non modifiable)</i></label>
                <input type="text" name="text_input_mon_code" value="<?php echo $utilisateur['code_administrateur'];?>" disabled/>
            
                <label for="text_input_validite_cle_de_licence">Validité de ma clé de licence  <i style="color:#ad0a03";>(non modifiable)</i></label>
                <input type="text" name="text_input_validite_cle_de_licence" value="<?php echo $utilisateur['date_fin_validite_licence'];?>" disabled/>
            
                <?php $icon=$utilisateur['icone_administrateur'];?>
            
                <label for="marker">Mon icône</label>
                <table width="100%" border="1" align="center">
                  <tr align="center">
                    <td><input type="radio" id="marker_user_1" name="marker" value="1" <?php if ($icon==1) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_1.png" /></td>
                    <td><input type="radio" id="marker_user_2" name="marker" value="2" <?php if ($icon==2) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_2.png" /></td>
                    <td><input type="radio" id="marker_user_3" name="marker" value="3" <?php if ($icon==3) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_3.png" /></td>
                    <td><input type="radio" id="marker_user_4" name="marker" value="4" <?php if ($icon==4) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_4.png" /></td>
                    <td><input type="radio" id="marker_user_5" name="marker" value="5" <?php if ($icon==5) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_5.png" /></td>
                  </tr>
                  <tr align="center">
                    <td><input type="radio" id="marker_user_6" name="marker" value="6" <?php if ($icon==6) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_6.png" /></td>
                    <td><input type="radio" id="marker_user_7" name="marker" value="7" <?php if ($icon==7) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_7.png" /></td>
                    <td><input type="radio" id="marker_user_8" name="marker" value="8" <?php if ($icon==8) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_8.png" /></td>
                    <td><input type="radio" id="marker_user_9" name="marker" value="9" <?php if ($icon==9) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_9.png" /></td>
                    <td><input type="radio" id="marker_user_10" name="marker" value="10" <?php if ($icon==10) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_10.png" /></td>
                  </tr>
                  <tr align="center">
                    <td><input type="radio" id="marker_user_11" name="marker" value="11" <?php if ($icon==11) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_11.png" /></td>
                    <td><input type="radio" id="marker_user_12" name="marker" value="12" <?php if ($icon==12) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_12.png" /></td>
                    <td><input type="radio" id="marker_user_13" name="marker" value="13" <?php if ($icon==13) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_13.png" /></td>
                    <td><input type="radio" id="marker_user_14" name="marker" value="14" <?php if ($icon==14) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_14.png" /></td>
                    <td><input type="radio" id="marker_user_15" name="marker" value="15" <?php if ($icon==15) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_15.png" /></td>
                  </tr>
                  <tr align="center">
                    <td><input type="radio" id="marker_user_16" name="marker" value="16" <?php if ($icon==16) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_16.png" /></td>
                    <td><input type="radio" id="marker_user_17" name="marker" value="17" <?php if ($icon==17) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_17.png" /></td>
                    <td><input type="radio" id="marker_user_18" name="marker" value="18" <?php if ($icon==18) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_18.png" /></td>
                    <td><input type="radio" id="marker_user_19" name="marker" value="19" <?php if ($icon==19) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_19.png" /></td>
                    <td><input type="radio" id="marker_user_20" name="marker" value="20" <?php if ($icon==20) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_20.png" /></td>
                  </tr>
                  <tr align="center">
                    <td><input type="radio" id="marker_user_21" name="marker" value="21" <?php if ($icon==21) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_21.png" /></td>
                    <td><input type="radio" id="marker_user_22" name="marker" value="22" <?php if ($icon==22) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_22.png" /></td>
                    <td><input type="radio" id="marker_user_23" name="marker" value="23" <?php if ($icon==23) {?>checked="checked"<?php };?>/><img src="<?php echo base_url();?>images/marker_user_23.png" /></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
            
                <p style="margin-top:20px;"><input id="button_submit" type="submit" value="Valider" /></p>

            <?php echo form_close();?>
            
            <p style="text-align:center;"><?php echo anchor('modification_password','Modifier mon mot de passe','target=_blank');?></p>
            
        </div>
        
        <div style="height:30px;"></div>
        
	</div>
</div>
    
    <footer>
    
        <p class="footer"><?php if(isset($footing)) echo $footing;?></p>
    
    </footer>
</body>
</html>
