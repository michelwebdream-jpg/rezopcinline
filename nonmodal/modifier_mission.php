<?php $burl=$_POST['burl']; ?>
<?php $data_pass=$_POST['data_pass'];?>
<script>var data_pass=<?php echo json_encode($data_pass);?>;</script>

<div id="id_view_modification_mission">
<div id="page_gerer_contact">
    
    <h2 style=" overflow: hidden; float: left;margin-top:0px;margin-bottom:0px;">Gestion des contacts</h2>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_page_gestion_des_contact_non_modal" class="bouton_fermer"> Fermer </a>
    </div>
    <div class="separator"></div>
    <hr />
    <table id="tableau_gestion_contact" class="display" cellspacing="0" >
    <thead>
    <tr>
        <th>Nom / Prénom</th>
        <th></th>
    </tr>
    </thead>
    
</table>
    
</div>
    
<h2  style=" overflow: hidden; float: left;margin-top: 5px;"><span id="titre_page_modification_mission"></span></h2>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
<div class="separator"></div>
<hr />


<details close>
          <summary>Instructions</summary>
          <p id="summary_edition_mission" style="text-align:center;font-size:14px;">Vous pouvez modifier le nom de cette mission. Vous pouvez aussi ajouter des moyens ou en enlever.<br />Pour enregistrer les modification cliquez sur le bouton "sauvegarder" en bas de page.</p>
        <p id="summary_nouvelle_mission" style="text-align:center;font-size:14px;">Vous devez renseigner le nom de cette mission. Vous devez aussi ajouter des moyens.<br />Pour enregistrer la nouvelle mission, cliquez sur le bouton "sauvegarder" en bas de page.</p>
        </details>

<div>
    <div id="left_detail_mission_update">
        <label for="textinput_titre_report_nouvelle_mission_modifier">Nom de la mission </label>
        <input type="text" name="textinput_titre_report_nouvelle_mission_modifier" id="textinput_titre_report_nouvelle_mission_modifier" value=""/>
        <label for="textinput_adresse_report_nouvelle_mission_modifier">Adresse</label>
        <input type="text" name="textinput_adresse_report_nouvelle_mission_modifier" id="textinput_adresse_report_nouvelle_mission_modifier" value="" />
        <label for="textinput_lien_googlemap_report_nouvelle_mission_modifier" >Lien GoogleMaps</label>
        <input type="text" name="textinput_lien_googlemap_report_nouvelle_mission_modifier" id="textinput_lien_googlemap_report_nouvelle_mission_modifier" value="" style="display:inline;width: 60%;"/><span style="float: right; margin-right: 20px"><a href ="#" id="bouton_obtenir_lien_google_map" class="bouton_fermer"> Obtenir le lien GoogleMaps </a></span>
        <label for="textinput_message_report_nouvelle_mission_modifier">Message</label>
        <textarea name="textinput_message_report_nouvelle_mission_modifier" id="textinput_message_report_nouvelle_mission_modifier" cols="20" rows="5"></textarea>
        <label for="combobox_duree_report_nouvelle_mission" style="display:inline">Validité de la mission : </label>
        <select id="combobox_duree_report_nouvelle_mission">
            
        </select>
    </div>
 
    <hr />

    <label for="code_personne_a_ajouter_mission"  style="display:inline-block;">Code de la personne a ajouter : </label>
    <input type="text" name="code_personne_a_ajouter_mission" id="code_personne_a_ajouter_mission" value="" style="display:inline-block;"/>
    <span style="display:inline-block";><a href ="#" id="bouton_ajouter_personne_dans_mission" class="bouton_fermer"> Ajouter </a></span><br />
    ou<br />
    <label for="choix_liste_code_personne_a_ajouter_mission"  style="display:inline-block;">Choisir dans la liste : </label>
    <span style="display:inline-block !important;">
    <select id="combobox_liste_code">
        <option value=""> Sélectionner un code </option>
        </select></span>
    <span style="display:inline-block !important;"><a href ="#" id="bouton_ajouter_personne_dans_mission_liste" class="bouton_fermer"> Ajouter </a></span>
    <span style="display:inline-block  !important;";><a href ="#" id="bouton_rafraichir_liste_code" class="bouton_fermer"> Rafraîchir la liste des codes </a></span>
    <span style="display:inline-block"  !important;;><a href ="#" id="bouton_gerer_liste_code" class="bouton_fermer"> Gérer </a></span>
</div>
<div class="separator" style="height:15px;"></div>
<table id="tableau_detail_mission_id_edition" class="display" cellspacing="0" >
    <thead>
    <tr>
        <th>Nom / Prénom</th>
        <th>Code REZO</th>
        <th>Indicatif</th>
        <th>Statut</th>
        <th>Action</th>
    </tr>
    </thead>
    
</table>
    <hr />
    <div>
        <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_page_modifier_mission_non_modal" class="bouton_fermer" style="width:100px;text-align:center"> Quitter </a>
        </div>
        <div style="float:right;display: flex;align-items: center;margin-right:10px;"><a href ="#" id="bouton_sauver_page_modifier_mission_non_modal" class="bouton_fermer" style="width:100px;text-align:center"> Sauvergarder </a>
        </div>
    </div>
</div>
<script>
        


    
$(document).ready( function () {
 
var table_gestion_contact;
var data_table_gestion_contact;
var table_detail_mission_edition;
var data_table_list_des_detail_missions_edition;
//var data_init_detail_edition = [{"nom":"","code":"","indicatif":""}];
var erreur_update_detail_mission_edition=0;
var mission_en_cours_de_detail_edition;
var jqxhr_detail_mission_edition;
var jqxhr_update_mission_edition;
var editing_mission_edition;
var Id_editing_mission_edition;
var mon_timer_mission_edition;
var page_modifier_mission_est_ferme;
    
function supprimer_utilisateur(code){
    var exist=false;
    var temp=mission_en_cours_de_detail_edition.split('{}');
    
    temp = jQuery.grep(temp, function(value) {
      return value != code;
    });
    
    mission_en_cours_de_detail_edition=temp.join('{}');
    clearTimeout(mon_timer_mission_edition);
    if (mission_en_cours_de_detail_edition.length>0){
        affiche_detail_mission_edition(mission_en_cours_de_detail_edition);    
    }else{
        table_detail_mission_edition.clear();
        table_detail_mission_edition.draw();
    }
    
} 
function supprimer_contact(code){
    
    	var $data={
            code_PC:Global.code_administrateur, 
            code_a_supprimer:code
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.EFFACE_CONTACT_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
        }
        else
        {
            refresh_combobox_liste_des_contacts();
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
      
  })
  .always(function() {

  })
  ;
    
}     
function InitOverviewDataTable_gestion_contact(){
  
  //initialize DataTables
  table_gestion_contact = $('#tableau_gestion_contact').DataTable({
      
      "autoWidth": false,
      "columnDefs": [ 
          {
            "targets": 0,
            "data": 'nom',
            "defaultContent": ""
        },
          {
            "targets": 1,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_supprimer'>Supprimer</button>"
        }],
      language: language_datatable
  });
    
  $('#tableau_gestion_contact tbody').on( 'click', '#button_supprimer', function (e) {
      
        e.stopPropagation();
        var data = table_gestion_contact.row( $(this).parents('tr') ).data();
        
      
      swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer ce contact de la liste ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            supprimer_contact(data.c3);
        });
      
      /*if (confirm('Êtes-vous sûr de vouloir effacer ce contact de la liste ?')) {
        supprimer_contact(data.c3);
      }*/
    } );
}
function affiche_detail_mission_edition(liste_des_codes){
    jqxhr_detail_mission_edition = $.post(Global.APP_SERVER_URL+Global.INFO_MISSION_URI,{ liste_des_codes:liste_des_codes})

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf=="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Actualisation impossible...'); 

        }else if (buf=="")
        {
				ouvre_alerte('Erreur réseau !<br />Actualisation impossible...'); 
        }
        else
        {
            
                var page_en_cours=table_detail_mission_edition.page();
                var page_max=table_detail_mission_edition.page.info().pages;
            
                table_detail_mission_edition.clear();
                table_detail_mission_edition.draw();

                var trame2=buf.split("\n");


                var code2= new Array(trame2.length);
                var statut2 = new Array(trame2.length);
                var nom2= new Array(trame2.length);
                var prenom2= new Array(trame2.length);
                var indicatif2= new Array(trame2.length);

                data_table_list_des_detail_missions_edition= new Array();
                for (i=0; i<trame2.length;i++)
                {
                    var temp2=trame2[i].split("><");
                    code2[i]=temp2[0];
                    statut2[i]=temp2[1];
                    nom2[i]=temp2[2];
                    prenom2[i]=temp2[3];
                    indicatif2[i]=temp2[4];

                    data_table_list_des_detail_missions_edition.push({nom:nom2[i] +" " + prenom2[i], code:code2[i], indicatif:indicatif2[i], statut:statut2[i], c4:""});
                }

                if (data_table_list_des_detail_missions_edition.length>0){

                    table_detail_mission_edition.clear();
                    table_detail_mission_edition.rows.add(data_table_list_des_detail_missions_edition);
                    table_detail_mission_edition.draw();
                    if (page_en_cours<=page_max){
                        table_detail_mission_edition.page(page_en_cours).draw('page');
                    }else{
                        table_detail_mission_edition.page(page_max).draw('page');
                    }
                    
                }else{

                    table_detail_mission_edition.clear();
                    table_detail_mission_edition.draw();
                }
                erreur_update_detail_mission_edition=0;
            
                if (!page_modifier_mission_est_ferme)
                {
                    mon_timer_mission_edition=setTimeout(function(){affiche_detail_mission_edition(mission_en_cours_de_detail_edition);}, 2000);
                }
                
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      erreur_update_detail_mission_edition++;
      if (erreur_update_detail_mission_edition>2){
          erreur_update_detail_mission_edition=0;
           table_detail_mission_edition.clear();
            table_detail_mission_edition.draw();
          ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'afficher le détail de la mission.');  
      }else{           
          if (!page_modifier_mission_est_ferme)
            {
                mon_timer_mission_edition=setTimeout(function(){affiche_detail_mission_edition(mission_en_cours_de_detail_edition);}, 2000);
            }
          
      }
     
  })
  .always(function() {

  })
  ;
    
    
}
function InitOverviewDataTable_detail_mission_edition(){
  
  //initialize DataTables
  table_detail_mission_edition = $('#tableau_detail_mission_id_edition').DataTable({
      
      "autoWidth": false,
      "columnDefs": [ 
          {
            "targets": 0,
            "data": 'nom',
            "defaultContent": ""
        },
          {
            "targets": 1,
            "data": 'code',
            "defaultContent": "",
            className: "td_center"
        },
          {
            "targets": 2,
            "data": 'indicatif',
            "defaultContent": ""
            
        },
          {
            "targets": 3,
            "data": 'statut',
            "defaultContent": "",
            "className": "td_center",      
        },
          {
            "targets": 4,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_supprimer'><img src='images/trash_recyclebin_empty_closed.png' width=20px height=20px></button>",
            "className": "td_center"
        }],
        "rowCallback": function( row, data, index ) {
            var statu = data.statut;

            if (statu === 'inactif') {
                $('td', row).css('background-color', '#e36c54');
            }else if (statu === 'actif'){
                $('td', row).css('background-color', '#53ab5b');
            }else{
                $('td', row).css('background-color', 'inherit');
            }
        },
      language: language_datatable
  });
  $('#tableau_detail_mission_id_edition tbody').on( 'click', '#button_supprimer', function (e) {
      
        e.stopPropagation();
        var data = table_detail_mission_edition.row( $(this).parents('tr') ).data();
        
      swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer cet utilisateur de la mission ?\nImportant : pour valider complètement cette suppression, vous devez sauver la mission à la fin des modifications.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            supprimer_utilisateur(data.code);
        });
      
      
         /* if (confirm('Êtes-vous sûr de vouloir effacer cet utilisateur de la mission ?\nImportant : pour valider complètement cette suppression, vous devez sauver la mission à la fin des modifications.')) {
            supprimer_utilisateur(data.code);
          }*/
    } );
}
function enregistre_mission(){
    if ($('#textinput_titre_report_nouvelle_mission_modifier').val()==="")
	{
		swal("Sauvegarde Impossible !","Le nom de la nouvelle mission doit être renseignée !","error");
		
	}else if (mission_en_cours_de_detail_edition.length>0){
		
		var nom_nouvelle_mission=$('#textinput_titre_report_nouvelle_mission_modifier').val();
        
		nom_nouvelle_mission = nom_nouvelle_mission.replace(/[&<>{}]/g, "-");

        var nom_nouvelle_mission=$('#textinput_titre_report_nouvelle_mission_modifier').val();
		nom_nouvelle_mission = nom_nouvelle_mission.replace(/[&<>{}]/g, "-");
		var adresse_mission=$('#textinput_adresse_report_nouvelle_mission_modifier').val();
		adresse_mission = adresse_mission.replace(/[&<>{}]/g, "-");
        
        
		var lien_googlemap=$('#textinput_lien_googlemap_report_nouvelle_mission_modifier').val();
		lien_googlemap = lien_googlemap.replace(/[&<>{}]/g, "-");
		var message_mission=$('#textinput_message_report_nouvelle_mission_modifier').val();
		message_mission = message_mission.replace(/[&<>{}]/g, "-");
		message_mission = message_mission.replace(/\n/g, "\r");
        
        var temp1=mission_en_cours_de_detail_edition.split("{}");
        
        var listofcodeasauver=temp1.join(",");
		
		var validite_mission=$('#combobox_duree_report_nouvelle_mission').find(":selected").val();
		
        
		if (editing_mission_edition)
		{
			update_nouvelle_mission_sur_serveur(Id_editing_mission_edition,nom_nouvelle_mission,adresse_mission,lien_googlemap,message_mission,listofcodeasauver,temp1.length,validite_mission);
		}else{
			sauve_nouvelle_mission_sur_serveur(nom_nouvelle_mission,adresse_mission,lien_googlemap,message_mission,listofcodeasauver,temp1.length,validite_mission);
		}
	}else{
		swal("Sauvegarde Impossible !","Il n'y a pas d'utilisateur dans cette mission !","error");
	}
}
function update_nouvelle_mission_sur_serveur(Id, nom_de_la_mission,adresse_mission,lien_googlemap_mission,message_mission,listofcodeasauver,Qte,validite_mission){
	
	var $data={
       Id:Id,
       mon_code:Global.code_administrateur,
	   nom_de_la_mission:nom_de_la_mission,
	   adresse_mission:adresse_mission,
	   lien_googlemap_mission:lien_googlemap_mission,
	   message_mission:message_mission,
	   codes_dans_la_mission:listofcodeasauver,
	   qte:Qte,
	   validite_mission:validite_mission
    }
    
    jqxhr_update_mission_edition = $.post(Global.APP_SERVER_URL+Global.UPDATE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Sauvegarde impossible...'); 

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Sauvegarde impossible...'); 
        }
        else if (buf==="1")
        {
                swal('Succès !','Sauvegarde effectuée.','success');
                $('#bouton_fermer_page_modifier_mission_non_modal').click();
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Sauvegarde impossible...'); 
      
  })
  .always(function() {

  })
  ;
	
}
function sauve_nouvelle_mission_sur_serveur(nom_de_la_mission,adresse_mission,lien_googlemap_mission,message_mission,listofcodeasauver,Qte,validite_mission){
    
    var $data={
        
       mon_code:Global.code_administrateur,
	   nom_de_la_mission:nom_de_la_mission,
	   adresse_mission:adresse_mission,
	   lien_googlemap_mission:lien_googlemap_mission,
	   message_mission:message_mission,
	   codes_dans_la_mission:listofcodeasauver,
	   qte:Qte,
	   validite_mission:validite_mission
    }
    
    jqxhr_update_mission_edition = $.post(Global.APP_SERVER_URL+Global.SAVE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Sauvegarde impossible...'); 

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Sauvegarde impossible...'); 
        }
        else if (buf==="1")
        {
                swal('Succès !','Sauvegarde effectuée.','success')
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Sauvegarde impossible...'); 
      
  })
  .always(function() {

  })
  ;
}
function enregistre_modification_mission_sur_serveur(Id, nom_de_la_mission,listofcodeasauver,Qte){
    
    var $data={
            Id:Id,
            mon_code:Global.code_administrateur,
            nom_de_la_mission:nom_de_la_mission,
            codes_dans_la_mission:listofcodeasauver,
            qte:Qte
        }
    
    jqxhr_update_mission_edition = $.post(Global.APP_SERVER_URL+Global.UPDATE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Mise à jour impossible...'); 

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Mise à jour impossible...'); 
        }
        else if (buf==="1")
        {
                swal('Succès !','Mise à jour effectuée.','success')
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Mise à jour impossible...'); 
      
  })
  .always(function() {

  })
  ;
}
function refresh_combobox_liste_des_contacts(){
    
    
    
    var $data={
            code_PC:Global.code_administrateur
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.RETOURNE_CONTACT_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            $('#combobox_liste_code').empty();
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Mise à jour de la liste des contacts impossible...'); 
        }
        else
        {
                var trame=buf.split("\n");
            
				$('#combobox_liste_code').empty();
				data_table_gestion_contact=new Array();
                table_gestion_contact.clear();
                table_gestion_contact.draw();
            
				var liste_des_contacts = new Array();
				
				for (i=0; i<trame.length;i++)
				{
					var temp=trame[i].split("><");
					
					var code=temp[0];
					var nom=temp[1];
					var prenom=temp[2];
					var indicatif=temp[3];
                    var compo_string=nom+" "+prenom+" - Id : "+indicatif;
                    
                    $('#combobox_liste_code').append(
                        $('<option>', {
                            value: code,
                            text: compo_string
                        }, '</option>'))
                    
                    data_table_gestion_contact.push({nom:compo_string, c3:code});
                    
                }
                table_gestion_contact.rows.add(data_table_gestion_contact);
                table_gestion_contact.draw();
            }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Mise à jour de la liste des contacts impossible...'); 
      
  })
  .always(function() {

  })
  ;
	
}   
function ajouter_nouvel_utilisateur(code){

    var exist=false;
    var temp=mission_en_cours_de_detail_edition.split('{}');

    for (i=0;i<temp.length;i++)
    {

        if (temp[i]===code)
        {
            exist=true;
        }
    }
    if (exist==true)
    {
        swal("Erreur !","Cet utilisateur est déjà dans la mission! Vous ne pouvez pas le rajouter de nouveau.","error");

    }else
    {
        FindInBDD(code);

    }
}
function FindInBDD(codeapasser){
    
    var $data={
            mon_code:codeapasser
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.FINDUSER_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            swal('Erreur !','Le code saisi est invalide ...','error'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
        }
        else
        {
                
				var separated = buf.split("\n");
				
                mission_en_cours_de_detail_edition=codeapasser+'{}'+mission_en_cours_de_detail_edition;
				
			     $('#code_personne_a_ajouter_mission').val("");	
                affiche_detail_mission_edition(mission_en_cours_de_detail_edition);
            
				ajoute_utilisateur_table_contact_PC(codeapasser);
				
			}
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
      
  })
  .always(function() {

  })
  ;
    
    
}
function ajoute_utilisateur_table_contact_PC(codeapasser){
	var $data={
           mon_code:codeapasser,
	       code_PC:Global.code_administrateur
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.AJOUTE_CODE_UTILISATEUR_DANS_TABLE_CONTACT_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
        }
        else
        {
        
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />nProblème technique...'); 
      
  })
  .always(function() {

  })
  ;
           
}
    
    $('#id_view_modification_mission').on('remove',function(){ 
        page_modifier_mission_est_ferme=true;
        jqxhr_detail_mission_edition.abort();
        jqxhr_update_mission_edition.abort();
        clearTimeout(mon_timer_mission_edition);
        table_detail_mission_edition.clear();
        table_detail_mission_edition.draw();
        table_gestion_contact.clear();
        table_gestion_contact.draw();
    });
    
    var option = '';
    for (var i=0;i<heure_jour_mois.length;i++){
       option += '<option value="'+ heure_jour_mois[i].data + '">' + heure_jour_mois[i].label + '</option>';
    }
    $('#combobox_duree_report_nouvelle_mission').append(option);
    
    InitOverviewDataTable_detail_mission_edition();
    InitOverviewDataTable_gestion_contact();
    
    mission_en_cours_de_detail_edition="";
    
    if (data_pass!==""){
        $('#summary_edition_mission').show();
        $('#summary_nouvelle_mission').hide();
        editing_mission_edition=true;
        Id_editing_mission_edition=data_pass.c6;
        $("#titre_page_modification_mission").html('Modification de la mission : '+ data_pass.mission);
        $('#textinput_titre_report_nouvelle_mission_modifier').val(data_pass.mission);
        
        var temp0=data_pass.c7;
            
        var temp1=temp0.split("<-+->");
	    var temp2=temp1[0].split(",");
	    var temp3=temp2.join("{}");

        
        
	    $('#textinput_adresse_report_nouvelle_mission_modifier').val(temp1[2]);
	    $('#textinput_lien_googlemap_report_nouvelle_mission_modifier').val(temp1[3]);
	    $('#textinput_message_report_nouvelle_mission_modifier').val(temp1[4]);
	
        
        $('#combobox_duree_report_nouvelle_mission option').each(function(){
            
        if($(this).val()===temp1[11]){
            
            $(this).prop('selected', true);
        }
            
    });
        
	   //$("select[id$='combobox_duree_report_nouvelle_mission'] option[value='"+temp1[11]+"']").attr("selected","selected"); //$('#textinput_validite_mission_report_nouvelle_mission_modifier').val(findItemLabel(report_info[11]));
        
        mission_en_cours_de_detail_edition=temp3;
            
        affiche_detail_mission_edition(mission_en_cours_de_detail_edition);

        $('#bouton_sauver_page_modifier_mission_non_modal').click(function() {
            enregistre_mission();
        });
    }else{
        $('#summary_edition_mission').hide();
        $('#summary_nouvelle_mission').show();
        editing_mission_edition=false;
        Id_editing_mission_edition=null;
        $("#titre_page_modification_mission").html('Création d\'une nouvelle mission');
        $('#bouton_sauver_page_modifier_mission_non_modal').click(function() {
            enregistre_mission();
        });
    }
    
    $('#bouton_rafraichir_liste_code').click(function() {
        refresh_combobox_liste_des_contacts();
    });
    
    $('#bouton_ajouter_personne_dans_mission').click(function() {

    	if ($('#code_personne_a_ajouter_mission').val().length<8)
		{
			swal("Ajout Impossible !","Le code a ajouter doit contenir au moins 8 caractères !","error");
		}else{
			if ($('#code_personne_a_ajouter_mission').val()===Global.code_administrateur)
			{
				swal("Ajout Impossible !","Il est interdit d'ajouter son propre code !","error");
				$('#code_personne_a_ajouter_mission').val("");
			}else{
				ajouter_nouvel_utilisateur($('#code_personne_a_ajouter_mission').val());
			}
		
  	}});
    
    $('#bouton_ajouter_personne_dans_mission_liste').click(function() {
        
    	ajouter_nouvel_utilisateur($('#combobox_liste_code').find('option:selected').val());
		
  	});
    
    $('#bouton_gerer_liste_code').click(function() {
        
    	$('#page_gerer_contact').show('fast');
		$('#page_gerer_contact').css({'top': 100,left:$("#id_view_modification_mission").parent().outerWidth()});
  	});
    
    $('#bouton_fermer_page_gestion_des_contact_non_modal').click(function() {
        
    	$('#page_gerer_contact').hide('fast');
		
  	});
    
    
    $('#bouton_obtenir_lien_google_map').click(function(){
        window.open('https://maps.google.com/?q='+$('#textinput_adresse_report_nouvelle_mission').val(), '_blank');
        
    });
    
    page_modifier_mission_est_ferme=false;
    
    refresh_combobox_liste_des_contacts();
    
});
    
</script>