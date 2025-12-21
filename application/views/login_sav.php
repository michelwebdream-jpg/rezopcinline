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
    <!---  ba7fd5f5 --->
</head>
<body>

<div id="container">
    <p style="text-align:center;">
    <a href="<?php echo base_url();?>"><img border="0" alt="Rezo+ pc inline" src="<?php echo base_url();?>images/icone_final_rezo_plus_PC_inline128.png" width="100" height="100"></a>
    </p>
    
	<h1 style="margin-bottom:0px;"><?php echo $heading;?></h1>
<p style="font-size:10px;text-align:center;"><?php echo version_du_soft; ?></p>
    <p style="text-align:center;">
    
        Merci d'avoir choisi REZO+ PC Inline !
    </p>
        
	<div id="container_formulaire">

        <div id="formulaire">
        
            <p style="font-size:18px;text-align:center;";>J'ai un compte REZO+ PC Inline : je m'identifie.</p>
            <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
            <?php endif;?>
            <hr /><div style="height:5px;"></div>

            <?php echo form_open('signup/login');?>

            <label for="code">Mon code REZO+</label>
            <input type="text" name="code" value="<?php echo set_value('code');?>"/>
            <?php echo form_error('code','<div class="error">','</div>');?>
            

            <label for="pass">Mon mot de passe</label>
            <input type="password" name="pass" value="<?php echo set_value('pass');?>"/>
            <?php echo form_error('pass','<div class="error">','</div>');?>
            

            <p style="margin-top:20px;"><input id="button_submit" type="submit" value="Entrer dans REZO+ PC Inline" /></p>

            <?php echo form_close();?>
            
        </div>
        <div style="height:30px;"></div>
        <div id="formulaire">
        
            <p style="font-size:18px;text-align:center;";>Je n'ai pas de compte REZO+ PC Inline : je dois en créer un.</p>
            <hr /><div style="height:5px;"></div>
            <?php //echo anchor('signup','Inscription');?>
            <p style="text-align:center;";><a href="<?php echo base_url();?>signup"><button type="button" id="button_creer_compte">Créer un compte</button></a></p>
            
            
        </div>
        
        <div style="height:30px;"></div>
        
	</div>
    
    
    
</div>
    
<div class="separator"></div>
    
    <footer>
    
        <p class="footer"><?php if(isset($footing)) echo $footing;?></p>
    
    </footer>
</body>
</html>