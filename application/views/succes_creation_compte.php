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
        
            <p style="font-size:22px;text-align:center;";>Compte créé.</p>
            
            <hr/>
            
            <p style="font-size:18px;text-align:center;"><strong>Votre compte vient d'être créé !<br />Notez bien votre code d'identification REZO +</strong></p>
            <p style="font-size:18px;text-align:center;border:1px solid;"><strong><?php echo $code_administrateur;?></strong></p>
            <p style="font-size:14px;text-align:center;">Vous pouvez aussi utiliser ce code d'identification pour les applications REZO+ et REZO+ PC pour Iphone/Ipad et Android</p>
            <p style="font-size:14px;text-align:center;">Votre clé de licence est valable jusqu'au :</p>
            <p style="font-size:14px;text-align:center;"><?php echo $date_fin_validite_licence;?></p>
            <p style="font-size:14px;text-align:center;">Un mail de confirmation vient de vous être envoyé...</p>
            <p style="font-size:14px;text-align:center;">Vous pouvez maintenant vous connecter à REZO+ PC InLine</p>
            <p style="text-align:center;";><a href="<?php echo base_url();?>signup/login" class="bouton_creer_un_compte">Me connecter.</a></p>

            
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
