<?php $burl=$_POST['burl']; ?>
<?php $version_soft=$_POST['version_soft']; ?>

<div id="id_view_a_propos">
<h1 style=" overflow: hidden; float: left;">A propos & Bug report</h1>
    
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_page_a_propos" class="bouton_fermer"> Fermer </a>
</div>
</div><div class="separator"></div>
<hr />
<div id="header_logo">
    <a href="https://www.web-dream.fr"  target="_black"><img border="0" alt="Web Dream" src="<?php echo $burl;?>images/Logo-Web-dream_240x240.png" width="100" height="100"></a>
    <h1>REZO+ PC Inline</h1>
    <p style="text-align:center;margin-top:5px;margin-bottom:5px;"><?php echo $version_soft?></p>
    <p>Conception et réalisation</p>
    <a href="https://www.web-dream.fr" target="_black">https://www.web-dream.fr</a>
    <p></p>
    <p>Pour tout bug ou remarques concernant cette application :</p>
    <a href="mailto:info@web-dream.fr">info@web-dream.fr</a>
    <p></p>
    <p>Copyright @ 2017 Web-Dream</p>
    <hr />
    <p><u>Un immense merci au créateur de ce grand projet :</u></p>
    <p>Monsieur Clement Marragou</p>
    <p><i>" Au plaisir de vous revoir ... "</i></p>
</div>

<script>
    


$(document).ready( function () {
    
   
    $('#bouton_fermer_page_a_propos').click(function() {
        ferme_page_a_propos();
    });
    
});
    
</script>