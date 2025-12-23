<?php $burl=$_POST['burl']; ?>


<div id="id_view_activite">
<h1 style=" overflow: hidden; float: left;">Mes activités / DPS</h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_non_modal" class="bouton_fermer"> Fermer </a>
</div>
<div style="float:right;display: flex;align-items: center;margin-right:10px;"><a href ="#" id="bouton_creer_nouvelle_activite" class="bouton_fermer"> + Créer une nouvelle activité / DPS</a></p>
</div>
<div class="separator"></div>
<hr />
<h2>Liste des activités enregistrées</h2>

<details close>
          <summary>Instructions</summary>
          <p style="text-align:center;font-size:14px;">Vous pouvez sélectionner une activité pour voir le détail en cliquant sur la ligne correspondante dans le tableau ci-dessous.</p>
</details>

<table id="tableau_activite_id" class="display" cellspacing="0" >
    <thead>
    <tr>
        <th>Activités</th>
        <th>Responsable PC</th>
        <th>Adresse de l'activité</th>
        <th>Nature du dispositif</th>
        <th>Remarques</th>
        <th>Moyens engagés</th>
        <th>Date de création</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    
</table>
<hr />
<h2>Détail de l'activité : <span id="titre_detail_activite"></span></h2>
<table id="tableau_detail_activite_id" class="display" cellspacing="0" >
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
<script>
        



    
$(document).ready( function () {
    
var table_activite;
var table_detail_activite;
var data_table_list_des_activites;
var data_table_list_des_detail_activites;
var data_init = [{"activite":"","utilisateur":"","date_creation":""}];

var erreur_update_detail_activite=0;
var activite_en_cours_de_detail;
var jqxhr_activite;
var jqxhr_detail_activite;

var page_activite_fermer;    

function modifier_indicatif_utilisateur(data_pass,nouveau_indicatif){
    
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

    
function supprime_activite(id_activite_a_supprimer){
        var $data={
            mon_code:Global.code_administrateur, 
            id_de_lactivite:id_activite_a_supprimer
        }
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.DELETE_ACTIVITE_URI,$data)

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
            swal("Succès","L'activité a bien étée supprimée.","success");
            actualise_liste_des_activites();
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Suppression impossible...'); 
      
  })
  .always(function() {

  })
  ;        
}
    
function InitOverviewDataTable_activite(){
  
  //initialize DataTables
  table_activite = $('#tableau_activite_id').DataTable({
      
      "autoWidth": false,
      "order": [[ 6, "desc" ]],
      "columnDefs": [ 
          {
            "targets": 0,
            "data": 'activite',
            "defaultContent": "",
            'width': '10%'
        },
          {
            "targets": 1,
            "data": 'nom_responsable',
            "defaultContent": "N.C.",
            className: "td_center"
        },
          {
            "targets": 2,
            "data": 'adresse',
            "defaultContent": "N.C.",
            className: "td_center"
        },{
            "targets": 3,
            "data": 'nature_activite',
            "defaultContent": "N.C.",
            className: "td_center"
        },
          {
            "targets": 4,
            "data": 'remarque',
            "defaultContent": "N.C.",
            className: "td_center"
        },
          {
            "targets": 5,
            "data": 'utilisateur',
            "defaultContent": "",
            className: "td_center"
        },
          {
            "targets": 6,
            "data": 'date_creation',
            "defaultContent": ""
            
        },
          {
            "targets": 7,
            "data": null,
              "orderable": false,
            className: "td_center",
            "defaultContent": "<button id='button_supprimer'><img src='images/trash_recyclebin_empty_closed.png' width=20px height=20px></button>"
        },
          {
            "targets": 8,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_modifier'><img src='images/icon_edit.png' width=20px height=20px></button>",
            className: "td_center"
        },
          {
            "targets": 9,
            "data": null,
              "orderable": false,
            "defaultContent": "<button class='button_geolocaliser bouton_contour_rouge'>Géolocaliser</button>"
        },
          {
            "targets": 10,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_historique' class='bouton_contour_rouge'>Historique</button>"
        },
          {
            "targets": 11,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_bilan_activite' class='bouton_contour_rouge'>Bilan</button>"
        },
          {
            "targets": 12,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_main_courante_activite' class='bouton_contour_rouge'>Main courante</button>"
        } ],
      language: language_datatable
  });
    $('#tableau_activite_id tbody').on( 'click', '#button_supprimer', function (e) {
      
        e.stopPropagation();
        var data = table_activite.row( $(this).parents('tr') ).data();
        
        swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer cette activité ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            supprime_activite(data.c6);
        });
        
        
        /*if (confirm('Êtes-vous sûr de vouloir effacer cette activité ?')) {
            supprime_activite(data.c6);
        }*/
        
    } );
    $('#tableau_activite_id tbody').on( 'click', '#button_modifier', function (e) {
        e.stopPropagation();
        var data = table_activite.row( $(this).parents('tr') ).data();
        ouvre_page_modifier_activiter(data);   
    } );
    $('#tableau_activite_id tbody').on( 'click', '.button_geolocaliser', function (e) {
        e.stopPropagation();
        e.preventDefault();
        console.log('Bouton géolocaliser cliqué (activité)');
        var data = table_activite.row( $(this).parents('tr') ).data();
        console.log('Données de l\'activité:', data);
        if (data && typeof lance_activite === 'function') {
            lance_activite(data);
        } else {
            console.error('Erreur: lance_activite n\'est pas une fonction ou data est invalide');
            if (!data) {
                console.error('data est null ou undefined');
            }
            if (typeof lance_activite !== 'function') {
                console.error('lance_activite n\'est pas définie');
            }
        }
    } );
    $('#tableau_activite_id tbody').on( 'click', '#button_historique', function (e) {
        e.stopPropagation();
        var data = table_activite.row( $(this).parents('tr') ).data();
        lit_historique_activite(data);
    } );
    $('#tableau_activite_id tbody').on( 'click', '#button_bilan_activite', function (e) {
        e.stopPropagation();
        var data = table_activite.row( $(this).parents('tr') ).data();
        ouvrir_page_bilan_victime(data.activite,data.c6,"activite");
    } );
    $('#tableau_activite_id tbody').on( 'click', '#button_main_courante_activite', function (e) {
        e.stopPropagation();
        var data = table_activite.row( $(this).parents('tr') ).data();
        ouvrir_page_main_courante(data.activite,data.c6,"activite");
    } );
  $('#tableau_activite_id').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table_activite.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            var temp1=table_activite.row( $(this) ).data().c7;

            var temp2=temp1.split(",");
            var temp3=temp2.join("{}");

            $('#titre_detail_activite').html(table_activite.row( $(this) ).data().activite);

            activite_en_cours_de_detail=temp3;

            affiche_detail_activite(temp3);
        }
    });

    actualise_liste_des_activites();
}
    
function lit_historique_activite(data_pass){
	
    affiche_page_historique(data_pass.activite,null,"activite");
	lit_historique(data_pass.activite);
    
}
    
function affiche_detail_activite(liste_des_codes){
    
    
    jqxhr_detail_activite = $.post(Global.APP_SERVER_URL+Global.INFO_ACTIVITE_URI,{ liste_des_codes:liste_des_codes})

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
                var page_en_cours=table_detail_activite.page();
                var page_max=table_detail_activite.page.info().pages;
            
            
                table_detail_activite.clear();
                table_detail_activite.draw();

                var trame2=buf.split("\n");


                var code2= new Array(trame2.length);
                var statut2 = new Array(trame2.length);
                var nom2= new Array(trame2.length);
                var prenom2= new Array(trame2.length);
                var indicatif2= new Array(trame2.length);

                data_table_list_des_detail_activites= new Array();
                for (i=0; i<trame2.length;i++)
                {
                    var temp2=trame2[i].split("><");
                    code2[i]=temp2[0];
                    statut2[i]=temp2[1];
                    nom2[i]=temp2[2];
                    prenom2[i]=temp2[3];
                    indicatif2[i]=temp2[4];

                    data_table_list_des_detail_activites.push({nom:nom2[i] +" " + prenom2[i], code:code2[i], indicatif:indicatif2[i], statut:statut2[i], c4:""});
                }

                if (data_table_list_des_detail_activites.length>0){

                    table_detail_activite.clear();
                    table_detail_activite.rows.add(data_table_list_des_detail_activites);
                    table_detail_activite.draw();
                    if (page_en_cours<=page_max){
                        table_detail_activite.page(page_en_cours).draw('page');
                    }else{
                        table_detail_activite.page(page_max).draw('page');
                    }
                    
                }else{

                    table_detail_activite.clear();
                    table_detail_activite.draw();
                }
                erreur_update_detail_activite=0;
            if (!page_activite_fermer){
                mon_timer_activite=setTimeout(function(){affiche_detail_activite(activite_en_cours_de_detail);}, 2000);
            }
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      erreur_update_detail_activite++;
      if (erreur_update_detail_activite>2){
          erreur_update_detail_activite=0;
           table_detail_activite.clear();
            table_detail_activite.draw();
          ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'afficher le détail de l\'activité.');  
      }else{          
          if (!page_activite_fermer){
              mon_timer_activite=setTimeout(function(){affiche_detail_activite(activite_en_cours_de_detail);}, 2000);
          }
          
      }
     
  })
  .always(function() {

  })
  ;
    
    
}
function actualise_liste_des_activites(){
    
    jqxhr_activite = $.post(Global.APP_SERVER_URL+Global.REFRESH_ACTIVITE_URI,{ mon_code:Global.code_administrateur})

    .done(function(data, textStatus, jqXHR ) {

        data=data.replace('return_txt=','');

        
        
        if (data==="-1"){
            table = $('#tableau_activite_id').DataTable();
            table.clear();
            table.draw();
            return;
        }
        
        var trame=data.split("\n");

        var qte= new Array();
        var titre = new Array();
        var membres= new Array();
        var date= new Array();
        var id= new Array();
        var nom_responsable= new Array();
        var adresse= new Array();
        var remarque= new Array();
        var nature_activite= new Array();
        var liens_kml= new Array();
        var marqueurs_fixes= new Array();
        
        data_table_list_des_activites= new Array();

        for (i=0; i<trame.length;i++)
            {
                var temp=trame[i].split("><");
                qte[i]=temp[0];
                titre[i]=temp[1];
                membres[i]=temp[2];
                date[i]=temp[3];
                id[i]=temp[4];
                nom_responsable[i]=temp[5];
                adresse[i]=temp[6];
                remarque[i]=temp[7];
                nature_activite[i]=temp[8];
                liens_kml[i]=temp[9];
                marqueurs_fixes[i]=temp[10];
                
                data_table_list_des_activites.push({activite:titre[i], nom_responsable:nom_responsable[i],adresse:adresse[i], nature_activite:nature_activite[i], remarque:remarque[i], utilisateur:qte[i], date_creation:date[i],c6:id[i], c7:membres[i], liens_kml:liens_kml[i], marqueurs_fixes:marqueurs_fixes[i]});
            }
        if (data_table_list_des_activites.length>0){
            
            jQuery.fn.dataTable.moment( 'DD-MM-YYYY HH:mm:ss' );
            
            table = $('#tableau_activite_id').DataTable();
            table.clear();
            table.rows.add(data_table_list_des_activites);
            table.draw();
        }else{
            table = $('#tableau_activite_id').DataTable();
            table.clear();
            table.draw();
        }
        for (i=0;i<data_table_list_des_activites.length;i++){
        
            var adresse=data_table_list_des_activites[i].adresse;
            adresse=adresse.replace(/ <br> /g, '\n');
            data_table_list_des_activites[i].adresse=adresse;
            
            var remarque=data_table_list_des_activites[i].remarque;
            remarque=remarque.replace(/ <br> /g, '\n');
            data_table_list_des_activites[i].remarque=remarque;
            
            var nature_activite=data_table_list_des_activites[i].nature_activite;
            nature_activite=nature_activite.replace(/ <br> /g, '\n');
            data_table_list_des_activites[i].nature_activite=nature_activite;
            
            var liens_kml=data_table_list_des_activites[i].liens_kml;
            liens_kml=liens_kml.replace(/ <br> /g, '\n');
            data_table_list_des_activites[i].liens_kml=liens_kml;
            
            var marqueurs_fixes=data_table_list_des_activites[i].marqueurs_fixes;
            marqueurs_fixes=marqueurs_fixes.replace(/ <br> /g, '\n');
            data_table_list_des_activites[i].marqueurs_fixes=marqueurs_fixes;
            
        }
    })
  .fail(function(jqXHR, textStatus, errorThrown) {
        table_activite.clear();
        table_activite.draw();
     ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'actualiser les activités');   

  })
  .always(function() {

  })
  ;
    
}
function InitOverviewDataTable_detail_activite(){
  
  //initialize DataTables
  table_detail_activite = $('#tableau_detail_activite_id').DataTable({
      
      "autoWidth": false,
      "columnDefs": [ 
          {
            "targets": 0,
            "data": 'nom',
            "defaultContent": "",
            className: "td_center"
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
            "defaultContent": "",
            className: "td_center"
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
            "defaultContent": "<button id='button_modifier_indicatif'>Modifier l'indicatif</button>",
            className: "td_center",
              
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
  $('#tableau_detail_activite_id tbody').on( 'click', '#button_modifier_indicatif', function (e) {
        e.stopPropagation();
        var data = table_detail_activite.row( $(this).parents('tr') ).data();
        modifier_indicatif_utilisateur(data);   
    } );
}
    
    $('#id_view_activite').on('remove',function(){ 
        
        page_activite_fermer=true;
        
        jqxhr_activite.abort();
        jqxhr_detail_activite.abort();
        clearTimeout(mon_timer_activite);
        table_detail_activite.clear();
        table_detail_activite.draw();
        table_activite.clear();
        table_activite.draw();
    });
    
    $('#bouton_creer_nouvelle_activite').click(function() {
        ouvre_page_modifier_activiter(null);   
    });
    
    page_activite_fermer=false;
    
    InitOverviewDataTable_activite();
    InitOverviewDataTable_detail_activite();
    
});
    
</script>