<?php $burl=$_POST['burl']; ?>

<div id="id_view_parametres">
<h1 style=" overflow: hidden; float: left;">Réglages</h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_page_parametres" class="bouton_fermer"> Fermer </a>
</div>
</div><div class="separator"></div>
<hr />
<label style="display:block;">
  <input type="checkbox" id="cbox_parametre_centrage_auto" value="checkbox1">
  Centrage automatique de la carte sur tous les utilisateurs.
</label>
<label>
  <input type="checkbox" id="cbox_parametre_alerte_sonore" value="checkbox1">
  Alerte sonore pour un départ en intervention ou une urgence.
</label>

<script>
    
function lecture_configuration_administrateur(){

      var $data={
            mon_code:Global.code_administrateur
        }
    
    var jqxhr_lit_historique = $.post(Global.APP_SERVER_URL+Global.FIND_PARAMETRES_ADMINISTRATEUR_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Impossible de lire vos réglages.');  

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Impossible de lire vos réglages.'); 
        }
        else
        {
                
                
				var temp=buf.split("><");
				//centrage_carte=temp[0];
				if (temp[0]==="1")
				{
                    $('input[id=cbox_parametre_centrage_auto]').prop("checked", true);
					
				}else{
					$('input[id=cbox_parametre_centrage_auto]').prop("checked", false);
				}
				var typedecarte=temp[1];

				if (temp[2]==="1")
				{
					$('input[id=cbox_parametre_alerte_sonore]').prop("checked", true);
				}else{
					$('input[id=cbox_parametre_alerte_sonore]').prop("checked", false);
				}
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible de lire vos réglages.'); 
     
  })
  .always(function() {
      
  })
  ;
}
function sauve_configuration_administrateur(){
    
    var centrage_carte="1";
    
    if ($('input[id=cbox_parametre_centrage_auto]').is(':checked'))
	{
		centrage_carte="1";
	}else{
		centrage_carte="0";
	}
	
    var alerte_sonore_depart_intervention="1";
    
	if ($('input[id=cbox_parametre_alerte_sonore]').is(':checked'))
	{
		alerte_sonore_depart_intervention="1";
	}else{
		alerte_sonore_depart_intervention="0";
	}
    
    var $data={
            mon_code:Global.code_administrateur,
        centrage_carte:centrage_carte,
        alerte_sonore_depart_intervention:alerte_sonore_depart_intervention,
        type_carte:"1"
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.UPDATE_PARAMETRES_ADMINISTRATEUR_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Impossible de mettre à jours vos réglages.');  

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Impossible de mettre à jours vos réglages.'); 
        }
        else
        {
                
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible de mettre à jours vos réglages.'); 
     
  })
  .always(function() {

  })
  ;
}

$(document).ready( function () {
    
   /* $('#bouton_sauver_parametres').click(function() {
        sauve_configuration_administrateur();
        ferme_page_reglages();
    });*/
    $('#bouton_fermer_page_parametres').click(function() {
        sauve_configuration_administrateur();
        ferme_page_reglages();
    });
    
    lecture_configuration_administrateur();
});
    
</script>