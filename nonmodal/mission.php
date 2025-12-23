<?php $burl=$_POST['burl']; ?>


<div id="id_view_mission">
<h1 style=" overflow: hidden; float: left;">Mes missions</h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_non_modal" class="bouton_fermer"> Fermer </a>
</div>
<div style="float:right;display: flex;align-items: center;margin-right:10px;"><a href ="#" id="bouton_creer_nouvelle_mission" class="bouton_fermer"> + Créer une nouvelle mission </a></p>
</div>
<div class="separator"></div>
<hr />
<h2>Liste des missions enregistrées</h2>

<details close>
          <summary>Instructions</summary>
          <p style="text-align:center;font-size:14px;">Vous pouvez sélectionner une mission pour voir le détail en cliquant sur la ligne correspondante dans le tableau ci-dessous.</p>
</details>

<table id="tableau_mission_id" class="display" cellspacing="0" >
    <thead>
    <tr>
        <th></th>
        <th>Missions</th>
        <th>Utilisateurs</th>
        <th>Date de création</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    
</table>
<hr />
<h2>Détail de la mission : <span id="titre_detail_mission"></span></h2>
<table id="tableau_detail_mission_id" class="display" cellspacing="0" >
    <thead>
    <tr>
        <th>Nom / Prénom</th>
        <th>Code REZO</th>
        <th>Indicatif</th>
        <th>Statut</th>
        <th>Validation mission</th>
        <th>Action</th>
    </tr>
    </thead>
    
</table>
<div>

<div id="left_detail_mission">
    <label for="textinput_titre_report_nouvelle_mission">Nom de la mission </label>
    <input type="text" name="textinput_titre_report_nouvelle_mission" id="textinput_titre_report_nouvelle_mission" value=""/>
    <label for="textinput_adresse_report_nouvelle_mission">Adresse</label>
    <input type="text" name="textinput_adresse_report_nouvelle_mission" id="textinput_adresse_report_nouvelle_mission" value="" />
    <label for="textinput_lien_googlemap_report_nouvelle_mission" >Lien GoogleMaps</label>
    <input type="text" name="textinput_lien_googlemap_report_nouvelle_mission" id="textinput_lien_googlemap_report_nouvelle_mission" value=""/>
    <label for="textinput_message_report_nouvelle_mission">Message</label>
    <textarea name="textinput_message_report_nouvelle_mission" id="textinput_message_report_nouvelle_mission" cols="20" rows="5"></textarea>
    <!--<input type="text" name="textinput_message_report_nouvelle_mission" id="textinput_message_report_nouvelle_mission" value=""/>-->
</div>

<div id="right_detail_mission">
    <label for="textinput_statut_report_nouvelle_mission">Statut</label>
    <input type="text" name="textinput_statut_report_nouvelle_mission" id="textinput_statut_report_nouvelle_mission" value=""/>
    <label for="textinput_date_lancement_report_nouvelle_mission">Date d'activation</label>
    <input type="text" name="textinput_date_lancement_report_nouvelle_mission" id="textinput_date_lancement_report_nouvelle_mission" value="" />
    <label for="textinput_date_cloture_report_nouvelle_mission" >Date de cloture</label>
    <input type="text" name="textinput_date_cloture_report_nouvelle_mission" id="textinput_date_cloture_report_nouvelle_mission" value=""/>
    <label for="textinput_validite_mission_report_nouvelle_mission">Validité de la mission</label>
    <input type="text" name="textinput_validite_mission_report_nouvelle_mission" id="textinput_validite_mission_report_nouvelle_mission" value=""/>
</div>


</div>

<script>
    
$(document).ready( function () {
    
var table_mission;
var table_detail_mission;
var data_table_list_des_missions;
var data_table_list_detail_des_missions;
var usergroupList_mission;

var erreur_update_detail_mission=0;
var mission_en_cours_de_detail;
var jqxhr_mission;
var jqxhr_detail_mission;
var mon_timer_mission;
var selected_mission;

var page_mission_fermer;    
    
function modifier_indicatif_utilisateur_mission(data_pass,nouveau_indicatif){
    
    swal({   title: "Modification d'indicatif",   text: "Entrez le nouvel indicatif.",   type: "input",   showCancelButton: true,   closeOnConfirm: false,   animation: "slide-from-top",   inputPlaceholder: "Nouvel indicatif" }, function(inputValue){   if (inputValue === false) return false;      if (inputValue === "") {     swal.showInputError("Vous devez saisir un nouvel indicatif!");     return false   }      
    
    var $data={
            code_utilisateur_a_modifier:data_pass.code, 
            nouveau_indicatif:inputValue
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.UPDATE_INDICATIF_USER_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf!=="ok")
        {
            ouvre_alerte('Erreur réseau !<br />modification impossible...'); 
        }
        else
        {
            swal("Succès","L'indicatif a bien été modifié.","success");
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Modification impossible...'); 
      
  })
  .always(function() {

  });    
    
 });
    
    
}
    
function supprime_mission(id_mission_a_supprimer){
        var $data={
            mon_code:Global.code_administrateur, 
            id_de_la_mission:id_mission_a_supprimer
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.DELETE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Suppression impossible...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Suppression impossible...'); 
        }
        else if (buf==="1")
        {
            swal("Succès","La mission a bien étée supprimée.","success");
            selected_mission=-1;
            actualise_liste_des_missions();
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Suppression impossible...'); 
      
  })
  .always(function() {

  })
  ;        
}
    
function InitOverviewDataTable_mission(){
  
  //initialize DataTables
  table_mission = $('#tableau_mission_id').DataTable({
      
      "autoWidth": false,
      "order": [[ 3, "desc" ]],
      "columnDefs": [ 
        {
            "targets": 0,
            "data": 'c0',
            "defaultContent": ""
        },{
            "targets": 1,
            "data": 'mission',
            "defaultContent": ""
        },
          {
            "targets": 2,
            "data": 'utilisateur',
            "defaultContent": "",
            className: "td_center"
        },
          {
            "targets": 3,
            "data": 'date_creation',
            "defaultContent": ""
            
        },
          {
            "targets": 4,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_supprimer'><img src='images/trash_recyclebin_empty_closed.png' width=20px height=20px></button>",
            className: "td_center"
        },
          {
            "targets": 5,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_modifier'><img src='images/icon_edit.png' width=20px height=20px></button>",
            className: "td_center"
        },
          {
            "targets": 6,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_activer' class='bouton_contour_rouge'>Activer</button>"
        },
          {
            "targets": 7,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_cloturer' class='bouton_contour_rouge'>Cloturer</button>"
        },
          {
            "targets": 8,
            "data": null,
              "orderable": false,
            "defaultContent": "<button class='button_geolocaliser bouton_contour_rouge'>Géolocaliser</button>"
        },{
            "targets": 9,
            "data": null,
            "orderable": false,
            "defaultContent": "<button id='button_historique' class='bouton_contour_rouge'>Historique</button>"
        },
          {
            "targets": 10,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_bilan_mission' class='bouton_contour_rouge'>Bilan</button>"
        } ],
      "rowCallback": function( row, data, index ) {
            var info_pass = data.c7;

            var info_pass_array=info_pass.split('<-+->');
            var etat_mission=info_pass_array[5];
            if (etat_mission==="0") {
                    $('td', row).css('background-color', 'inherit');
                    //MyCellRenderer_grid_mission.selectIndex (i,2);
                }else if (etat_mission==="1")
                {
                    $('td', row).css('background-color', '#53ab5b');
                    //MyCellRenderer_grid_mission.selectIndex (i,1);
                }
                else if (etat_mission==="2")
                {
                    $('td', row).css('background-color', '#e36c54');
                    //MyCellRenderer_grid_mission.selectIndex (i,0);
                }
        },
      language: language_datatable
  });
    $('#tableau_mission_id tbody').on( 'click', '#button_supprimer', function (e) {
      
        e.stopPropagation();
        var data = table_mission.row( $(this).parents('tr') ).data();
        
        swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir supprimer cette mission ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            supprime_mission(data.c6);
        });
        
        
        /*if (confirm('Êtes-vous sûr de vouloir supprimer cette mission ?')) {
            supprime_mission(data.c6);
        }*/
        
    } );
    $('#tableau_mission_id tbody').on( 'click', '#button_modifier', function (e) {
        e.stopPropagation();
        var data = table_mission.row( $(this).parents('tr') ).data();
        ouvre_page_modifier_mission(data);   
    } );
    $('#tableau_mission_id tbody').on( 'click', '.button_geolocaliser', function (e) {
        e.stopPropagation();
        e.preventDefault();
        console.log('Bouton géolocaliser cliqué');
        var data = table_mission.row( $(this).parents('tr') ).data();
        console.log('Données de la mission:', data);
        if (data && typeof lance_mission === 'function') {
            lance_mission(data);
        } else {
            console.error('Erreur: lance_mission n\'est pas une fonction ou data est invalide');
            if (!data) {
                console.error('data est null ou undefined');
            }
            if (typeof lance_mission !== 'function') {
                console.error('lance_mission n\'est pas définie');
            }
        }
    } );
    $('#tableau_mission_id tbody').on( 'click', '#button_activer', function (e) {
        e.stopPropagation();
        var data = table_mission.row( $(this).parents('tr') ).data();
        active_mission(data);
    } );
    $('#tableau_mission_id tbody').on( 'click', '#button_cloturer', function (e) {
        e.stopPropagation();
        var data = table_mission.row( $(this).parents('tr') ).data();
        cloturer_mission(data);
    } );
    $('#tableau_mission_id tbody').on( 'click', '#button_historique', function (e) {
        e.stopPropagation();
        var data = table_mission.row( $(this).parents('tr') ).data();
        lit_historique_mission_local(data);
    } );
    $('#tableau_mission_id tbody').on( 'click', '#button_bilan_mission', function (e) {
        e.stopPropagation();
        var data = table_mission.row( $(this).parents('tr') ).data();
        ouvrir_page_bilan_victime(data.mission,data.c6,"mission");
    } );
  $('#tableau_mission_id').on( 'click', 'tr', function () {
        
            selected_mission=$(this);
      
            
      
            table_mission.rows().every(function( rowIdx, tableLoop, rowLoop ){
            
                var data_row_temp = this.data();
                data_row_temp['c0']='';
                this.data(data_row_temp);
                table_mission.draw();
            });
      
            var data_row_temp = table_mission.row( $(this) ).data();
            data_row_temp['c0']='<strong>></strong>';
            table_mission.row( $(this) ).data(data_row_temp);
            table_mission.draw();
            
            var temp0=table_mission.row( $(this) ).data().c7;
            
            var temp1=temp0.split("<-+->");
	        var temp2=temp1[0].split(",");
	        var temp3=temp2.join("{}");
	
            $('#titre_detail_mission').html(table_mission.row( $(this) ).data().mission);
	       
            mission_en_cours_de_detail=temp3;
            
            affiche_detail_mission(temp3,temp1,false);
        
    });

    selected_mission=-1;
    actualise_liste_des_missions();
}
    
function lit_historique_mission_local(data_pass){
	
    affiche_page_historique(data_pass.mission,data_pass.c6,"mission");
	lit_historique_mission(data_pass.c6);
    
}
    

function actualise_liste_des_missions(){
    
    jqxhr_mission = $.post(Global.APP_SERVER_URL+Global.REFRESH_MISSION_URI,{ mon_code:Global.code_administrateur})

    .done(function(data, textStatus, jqXHR ) {

        data=data.replace('return_txt=','');

        if (data==="-1")
			{
                
                
                
                table_detail_mission.clear();
                table_detail_mission.draw();
                table_mission.clear();
                table_mission.draw();
				/*
				Titre_detail_mission.text="Détail de la mission : ";
				
				usergroupList_mission.splice(0, usergroupList_mission.length);
				newsusergroupList_mission.splice(0, usergroupList_mission.length);
				efface_champs_detail_mission()
				efface_champs_report_mission();*/
				selected_mission=-1;
				
			}else if (data==="")
			{
				//ouvre_infobox("",1,"Erreur réseau !","Problème technique...");
			}
			else
			{    
        
                var page_en_cours_table_mission=table_mission.page();
                var page_max_table_mission=table_mission.page.info().pages;
        /*var array_data=Array.from(data);
        for (i=0;i<array_data.length;i++){
            console.log('i:'+i+'-'+array_data[i].charCodeAt(0));
        }*/
                
        var trame=data.split("\n");

        var qte= new Array(trame.length);
        var titre = new Array(trame.length);
        var membres= new Array(trame.length);
        var date= new Array(trame.length);
        var id= new Array(trame.length);
        var adresse_mission= new Array(trame.length);
        var	lien_googlemap_mission= new Array(trame.length);
        var	message_mission= new Array(trame.length);
        var	etat_mission= new Array(trame.length);
        var date_lancement= new Array(trame.length);
        var date_cloture= new Array(trame.length);
        var membres_lu_mission= new Array(trame.length);
        var membres_refus_mission= new Array(trame.length);
        var membres_fini_mission= new Array(trame.length);
        var validite_mission= new Array(trame.length);

        data_table_list_des_missions= new Array();

        for (i=0; i<trame.length;i++)
            {
                var temp=trame[i].split("><");
                qte[i]=temp[0];
                titre[i]=temp[1];
                adresse_mission[i]=temp[2];
                lien_googlemap_mission[i]=temp[3];
                message_mission[i]=temp[4];
                
                etat_mission[i]=temp[5];
                date_lancement[i]=temp[6];
                date_cloture[i]=temp[7];
                membres[i]=temp[8];
                date[i]=temp[9];
                membres_lu_mission[i]=temp[10];
                membres_refus_mission[i]=temp[11];
                membres_fini_mission[i]=temp[12];
                validite_mission[i]=temp[13];
                id[i]=temp[14];

                var info_cache=membres[i]+"<-+->"+titre[i]+"<-+->"+adresse_mission[i]+"<-+->"+lien_googlemap_mission[i]+"<-+->"+message_mission[i]+"<-+->"+etat_mission[i]+"<-+->"+date_lancement[i]+"<-+->"+date_cloture[i]+"<-+->"+membres_lu_mission[i]+"<-+->"+membres_refus_mission[i]+"<-+->"+membres_fini_mission[i]+"<-+->"+validite_mission[i];
                
                                
                data_table_list_des_missions.push({c0:"", mission:titre[i], utilisateur:qte[i], date_creation:date[i], c4:"", c5:"", c6:id[i], c7:info_cache});
                
                
            }

            if (data_table_list_des_missions.length>0){
                
                table_mission.clear();
                table_mission.rows.add(data_table_list_des_missions);
                table_mission.draw();
                
                if (page_en_cours_table_mission<=page_max_table_mission){
                        table_mission.page(page_en_cours_table_mission).draw('page');
                    }else{
                        table_mission.page(page_max_table_mission).draw('page');
                    }
                
            }else{
                
                table_mission.clear();
                table_mission.draw();
            }
              
            table_mission.rows().every(function( rowIdx, tableLoop, rowLoop ){

                    var data_row_temp = this.data();
                    data_row_temp['c0']='';
                    this.data(data_row_temp);
                    table_mission.draw();
                });
                
            if (selected_mission!=-1){
			/*		data_table_list_des_missions.selectedIndex=selected_mission;
					traite_gridActiviteItemSelected(selected_mission);*/
                
                    

                    var data_row_temp = table_mission.row( selected_mission ).data();
                    data_row_temp['c0']='<strong>></strong>';
                    table_mission.row( selected_mission ).data(data_row_temp);
                    table_mission.draw();

                    var temp0=table_mission.row( selected_mission ).data().c7;

                    var temp1=temp0.split("<-+->");
                    var temp2=temp1[0].split(",");
                    var temp3=temp2.join("{}");

                    $('#titre_detail_mission').html(table_mission.row( selected_mission ).data().mission);

                    mission_en_cours_de_detail=temp3;

                    affiche_detail_mission(temp3,temp1,false);

				}else{
					data_table_list_detail_des_missions=new Array();
					usergroupList_mission=new Array();
					efface_champs_report_mission();
                    table_detail_mission.clear();
                    table_detail_mission.draw();
				}
        }
    })
  .fail(function(jqXHR, textStatus, errorThrown) {
    
    table_mission.clear();
    table_mission.draw();
     ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'actualiser les missions');   

  })
  .always(function() {

  })
  ;
    if (!page_mission_fermer){
        mon_timer_mission=setTimeout(function(){actualise_liste_des_missions();}, 2000);
    }
    
}
function InitOverviewDataTable_detail_mission(){
  
  //initialize DataTables
  table_detail_mission = $('#tableau_detail_mission_id').DataTable({
      
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
            "data": 'validation_mission',
            "defaultContent": "",
            "className": "td_center",      
        },
          {
            "targets": 5,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_modifier_indicatif_mission'>Modifier l'indicatif</button>"
        }],
        "rowCallback": function( row, data, index ) {
            var statu = data.statu;
            var etat = data.etat;
            
            var dispo=false;
			var en_mission=false;

            if (statu==="actif" && etat==="1")
            {
                dispo=true;
            }
            if (statu==="actif" && etat!=="1" && etat!=="0")
            {
                en_mission=true;
            }
            if (dispo) {
                $('td', row).css('background-color', '#53ab5b');
            }else if (en_mission)
            {
                $('td', row).css('background-color', '#e0944b');
            }else{
                $('td', row).css('background-color', 'rgb(225, 38, 14)');
            }

        },
      language: language_datatable
  });
  $('#tableau_detail_mission_id tbody').on( 'click', '#button_modifier_indicatif_mission', function (e) {
        e.stopPropagation();
        var data = table_detail_mission.row( $(this).parents('tr') ).data();
        modifier_indicatif_utilisateur_mission(data);   
    } );
}
  
function efface_champs_report_mission(){
    
    $('#textinput_titre_report_nouvelle_mission').val('');
	$('#textinput_adresse_report_nouvelle_mission').val('');
	$('#textinput_lien_googlemap_report_nouvelle_mission').val('');
	$('#textinput_message_report_nouvelle_mission').val('');
    $('#textinput_statut_report_nouvelle_mission').val('');
	$('#textinput_statut_report_nouvelle_mission').css({'background-color' : '#FFFFFF'});
	$('#textinput_date_lancement_report_nouvelle_mission').val('');
	$('#textinput_date_cloture_report_nouvelle_mission').val('');
    $('#textinput_validite_mission_report_nouvelle_mission').val('');
    
}

function findItemLabel (dataString) {
var Label_cherche = "";
    
for (i = 0; i < heure_jour_mois.length; i++) {
    
    if (heure_jour_mois[i].data === dataString) {
        Label_cherche = heure_jour_mois[i].label;
        break;
    }
    else {
    }
}
    
return Label_cherche;
}
    
function trouve_final_etat(statut,etat){
	if (statut==="inactif")
	{
		return "Non connecté";
	}else{
		if (statut==="actif")
		{
			return "Connecté / "+etat;
		}
	}
	return "...";
}
    
function retour_string_etat(valeur){
	if (valeur==="1") return "Opérationnel";
	if (valeur==="2") return "Départ";
	if (valeur==="3") return "Intervention";
	if (valeur==="4") return "Retour";
	if (valeur==="5") return "Urgence";
	return "...";
}
    
function affiche_detail_mission(liste_des_codes,report_info,is_editing){
	
	$('#textinput_titre_report_nouvelle_mission').val(report_info[1]);
	$('#textinput_adresse_report_nouvelle_mission').val(report_info[2]);
	$('#textinput_lien_googlemap_report_nouvelle_mission').val(report_info[3]);
	$('#textinput_message_report_nouvelle_mission').val(report_info[4]);
	
	$('#textinput_validite_mission_report_nouvelle_mission').val(findItemLabel(report_info[11]));
	
	var statut=report_info[5];
    
	if (statut==="0")
	{
		$('#textinput_statut_report_nouvelle_mission').val("En attente d'activation");
		//$('textinput_statut_report_nouvelle_mission').textField.background = true;
		$('#textinput_statut_report_nouvelle_mission').css({'background-color' : '#FFFFFF'});
		$('#textinput_date_lancement_report_nouvelle_mission').val("");
		$('#textinput_date_cloture_report_nouvelle_mission').val("");
	}else if (statut==="1"){
		$('#textinput_statut_report_nouvelle_mission').val("Activée - En cours d'exécution");
		//$('textinput_statut_report_nouvelle_mission').textField.background = true;
		$('#textinput_statut_report_nouvelle_mission').css({'background-color' : '#53ab5b'});
		$('#textinput_date_lancement_report_nouvelle_mission').val(report_info[6]);
		$('#textinput_date_cloture_report_nouvelle_mission').val("");
	}else if (statut==="2"){
		$('#textinput_statut_report_nouvelle_mission').val("Cloturée");
		//$('textinput_statut_report_nouvelle_mission').textField.background = true;
		$('#textinput_statut_report_nouvelle_mission').css({'background-color' : '#e36c54'});
		$('#textinput_date_lancement_report_nouvelle_mission').val(report_info[6]);
		$('#textinput_date_cloture_report_nouvelle_mission').val(report_info[7]);
	}
	
	jqxhr_detail_mission = $.post(Global.APP_SERVER_URL+Global.INFO_MISSION_URI,{ liste_des_codes:liste_des_codes})
    
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
            
            var page_en_cours_detail_table_mission=table_detail_mission.page();
                var page_max_detail_table_mission=table_detail_mission.page.info().pages;
            
                if (is_editing){
					
					data_table_list_detail_des_missions=new Array();
					
					var trame=buf.split("\n");
							
					
					var code= new Array(trame.length);
					var statut = new Array(trame.length);
					var nom= new Array(trame.length);
					var prenom= new Array(trame.length);
					var indicatif= new Array(trame.length);
					var etat= new Array(trame.length);
							
					for (i=0; i<trame.length;i++)
					{
						var temp=trame[i].split("><");
						code[i]=temp[0];
						statut[i]=temp[1];
						nom[i]=temp[2];
						prenom[i]=temp[3];
						indicatif[i]=temp[4];
						etat[i]=retour_string_etat(temp[7]);
						
						var final_etat=trouve_final_etat(statut[i],etat[i]);

						data_table_list_detail_des_missions.push({nom:nom[i] +" " + prenom[i], code:code[i], indicatif:indicatif[i], statut:final_etat, validation_mission:"",etat:temp[7],statu:statut[i]});
						
						/*var Nug=new Newusergroup();
					
						Nug.setNewusergroup(nom[i]+" "+prenom[i] , code[i] ,null );
					
						newusergroupList.push(Nug);*/
					
					}
                    table_detail_mission.clear();
                    table_detail_mission.rows.add(data_table_list_detail_des_missions);
                    table_detail_mission.draw();
                    
                    if (page_en_cours_detail_table_mission<=page_max_detail_table_mission){
                        table_detail_mission.page(page_en_cours_detail_table_mission).draw('page');
                    }else{
                        table_detail_mission.page(page_max_detail_table_mission).draw('page');
                    }
                    
				}else{
					
					data_table_list_detail_des_missions=new Array();
					
					var trame2=buf.split("\n");
							
					
					var code2= new Array(trame2.length);
					var statut2 = new Array(trame2.length);
					var nom2= new Array(trame2.length);
					var prenom2= new Array(trame2.length);
					var indicatif2= new Array(trame2.length);
					var etat2= new Array(trame2.length);
							
					for (i=0; i<trame2.length;i++)
					{
						var temp2=trame2[i].split("><");
						code2[i]=temp2[0];
						statut2[i]=temp2[1];
						nom2[i]=temp2[2];
						prenom2[i]=temp2[3];
						indicatif2[i]=temp2[4];
						etat2[i]=retour_string_etat(temp2[7]);
						
						var final_etat2=trouve_final_etat(statut2[i],etat2[i]);
						
						
						var a_lu="";
						
						var membres_refus_mission=report_info[9];
						var membres_refus_mission_array=membres_refus_mission.split(","); 
						for (k=0;k<membres_refus_mission_array.length;k++)
						{
							if (membres_refus_mission_array[k]===code2[i])
							{
								a_lu="Mission refusée";
							}
						}
						
						if (a_lu===""){
							var membres_fini_mission=report_info[10];
							var membres_fini_mission_array=membres_fini_mission.split(","); 
							for (k=0;k<membres_fini_mission_array.length;k++)
							{
								if (membres_fini_mission_array[k]===code2[i])
								{
									a_lu="Mission finie.";
								}
							}
						}
						if (a_lu===""){
							var membres_lecture_mission=report_info[8];
							var membres_lecture_mission_array=membres_lecture_mission.split(","); 
							for (k=0;k<membres_lecture_mission_array.length;k++)
							{
								if (membres_lecture_mission_array[k]===code2[i])
								{
									a_lu="Mission acceptée - en cours ...";
								}
							}
						}
						
						if (a_lu===""){
							a_lu="---";
						
						}
						
                        data_table_list_detail_des_missions.push({nom:nom2[i] +" " + prenom2[i], code:code2[i], indicatif:indicatif2[i], statut:final_etat2, validation_mission:a_lu,etat:temp2[7],statu:statut2[i]});
						
						/*var Nug2:Newusergroup=new Newusergroup();
					
						Nug2.setNewusergroup(nom2[i]+" "+prenom2[i] , code2[i] ,null );
					
						usergroupList.push(Nug2);*/
					
					}
                    table_detail_mission.clear();
                    table_detail_mission.rows.add(data_table_list_detail_des_missions);
                    table_detail_mission.draw();
                    
                    if (page_en_cours_detail_table_mission<=page_max_detail_table_mission){
                        table_detail_mission.page(page_en_cours_detail_table_mission).draw('page');
                    }else{
                        table_detail_mission.page(page_max_detail_table_mission).draw('page');
                    }
                    
				}
        }
		        
      })
    
    .fail(function(jqXHR, textStatus, errorThrown) {
      
     
  })
  .always(function() {

  })
  ;
   

}   
   
function active_mission(data_pass){
	
	var temp0=data_pass.c7;				
	var extra_info_array=temp0.split("<-+->");
	//statut=0 pas encore lancee on peut l'éditer
	if (extra_info_array[5]==="1") 
	{
		swal("Activation Impossible!","Cette mission est déjà active. Veuillez la cloturer avant de l'activer de nouveau.","error");
		return;
	}
	
    var $data={
       mon_code:Global.code_administrateur,
	   id_de_la_mission:data_pass.c6
    }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.ACTIVE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Activation impossible...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Activation impossible...'); 
        }
        else if (buf==="1")
        {
               ajoute_dans_historique_mission(data_pass.c6,$('#div_horloge').html()+","+"Activation de la mission : "+data_pass.mission);

            swal("Succès !","Mission activée.","success");
			
            //actualise_liste_des_missions(Index);
            
            //selected_mission=-1;
            //actualise_liste_des_missions();
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Activation impossible...'); 
      
  })
  .always(function() {

  })
  ;       
    
}

function cloturer_mission(data_pass){
	
	var temp0=data_pass.c7;				
	var extra_info_array=temp0.split("<-+->");
	//statut=0 pas encore lancee on peut l'éditer
	if (extra_info_array[5]==="2") 
	{
		swal("Cloture Impossible !","Cette mission est déjà cloturée.","error");
		return;
	}
	
    var $data={
       mon_code:Global.code_administrateur,
	   id_de_la_mission:data_pass.c6
    }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.CLOTURER_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Cloture de la mission impossible...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Cloture de la mission impossible...'); 
        }
        else if (buf==="1")
        {
          ajoute_dans_historique_mission(data_pass.c6,$('#div_horloge').html()+","+"Mission cloturée");
		  swal("Succès !","La mission est bien cloturée.","success");
				//actualise_liste_des_missions(Index);
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Cloture de la mission impossible...'); 
      
  })
  .always(function() {

  })
  ;       
    
	
}
    

    $('#id_view_mission').on('remove',function(){ 
        page_mission_fermer=true;
        jqxhr_mission.abort();
        jqxhr_detail_mission.abort();
        clearTimeout(mon_timer_mission);
        table_detail_mission.clear();
        table_detail_mission.draw();
        table_mission.clear();
        table_mission.draw();
    });
    
    $('#bouton_creer_nouvelle_mission').click(function() {
        ouvre_page_modifier_mission(null);   
    });
    page_mission_fermer=false;
    InitOverviewDataTable_mission();
    selected_mission=-1;
    InitOverviewDataTable_detail_mission();
    
});
    
</script>