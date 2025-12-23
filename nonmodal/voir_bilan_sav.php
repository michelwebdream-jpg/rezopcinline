<?php $burl=$_POST['burl']; $pass1=$_POST['pass1'];$pass2=$_POST['pass2'];$pass3=$_POST['pass3'];?>

<div id="id_view_voir_bilan">
    <?php
    if ($pass3=='activite'){
        $titre="Bilan des victimes de l'activité : " . $pass1;
    }else if ($pass3=='mission'){
        $titre="Bilan des victimes de la mission : " . $pass1;
    }else{
        $titre="";
    }
    ?>
<h1 style=" overflow: hidden; float: left;"><?php echo $titre; ?></h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    <div style="float:right;display: flex;align-items: center;">
        <a href ="#" id="bouton_export_pdf_bilan" class="bouton_fermer" style="margin-right:10px;"> Exporter au format PDF </a>
        <a href ="#" id="bouton_fermer_non_modal" class="bouton_fermer"> Fermer </a>
    </div>

<div class="separator"></div>
<hr />

    
    
<table id="tableau_victime" class="display" cellspacing="0" >
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Identification</th>
        <th>Naissance</th>
        <th>Age</th>
        <th>Sexe</th>
        <th>Nationalité</th>
        <th>Adresse</th>
        <th>Commentaire</th>
        <th>Horaires</th>
        <th>Type Intervention</th>
        <th>Centre Accueil</th>
        <th>Date création</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    
</table>
    
    
    <div class="legende_bilan">
    
        <div style='height:20px;background-color:#fff;color:#000;display: inline-block;padding:5px;margin:5px'> Non Renseigné </div>
        <div style='height:20px;background-color:#e36c54;color:#000;display: inline-block;padding:5px;margin:5px'> Victime encore au PC </div>
        <div style='height:20px;background-color:#53ab5b;color:#000;display: inline-block;padding:5px;margin:5px'> Victime sortie du PC </div>
    </div>
    

    
<script>
    
$(document).ready( function () {
    
    
var pass1="<?php echo $pass1; ?>";
var pass2="<?php echo $pass2; ?>";
var pass3="<?php echo $pass3; ?>";
    
var titre= "<?php echo $titre; ?>";
    
var table_victime;
var data_table_list_victime;
var data_init = [{"nom":"","prenom":"","date_creation":""}];

var jqxhr_victime;

var page_bilan_fermer;    
var data_table_pdf=new Array();

$("#bouton_export_pdf_bilan").on("click", function() {
    
    var heure_impression=$('#div_horloge').text();    

    var columns = [
        {title: "Nom", dataKey: "nom"},
        {title: "Prénom", dataKey: "prenom"}, 
        {title: "Identification", dataKey: "identification"},
        {title: "Date Naissance", dataKey: "date_naissance"},
        {title: "Age", dataKey: "age"},
        {title: "Sexe", dataKey: "sexe"},
        {title: "Nationalité", dataKey: "nationalite"},
        {title: "Adresse", dataKey: "adresse"},
        {title: "Commentaire", dataKey: "commentaire"},
        {title: "Horaires", dataKey: "horaires"},
        {title: "Type d'intervention", dataKey: "type_intervention"},
        {title: "Centre d'accueil", dataKey: "centre_accueil"},
        {title: "Date de création", dataKey: "date_creation"},
    ];

    var rows = data_table_pdf;
    var doc = new jsPDF('landscape', 'pt');

    doc.autoTable(columns, rows, {
        theme: 'striped',
        styles: { overflow:'linebreak',columnWidth: 'auto'},
        columnStyles: {nom:{columnWidth: 50},prenom:{columnWidth: 50},adresse: {columnWidth: 70},age:{columnWidth: 'wrap'},sexe:{columnWidth: 'wrap'},date_naissance:{columnWidth: 'wrap'},nationalite:{columnWidth: 'wrap'},identification:{columnWidth: 'wrap'}},
        // Properties
        fontSize: 8,

        startY: false, // false (indicates margin top value) or a number
        margin: {top: 60}, // a number, array or object
        pageBreak: 'auto', // 'auto', 'avoid' or 'always'
        tableWidth: 'auto', // 'auto', 'wrap' or a number, 
        showHeader: 'everyPage', // 'everyPage', 'firstPage', 'never',
        tableLineColor: 200, // number, array (see color section below)
        tableLineWidth: 0,
        addPageContent: function(data) {

            doc.text(titre, 40, 30);
            doc.setFontSize(10);
            doc.text("Date d'impression : " + heure_impression, 40, 45);
        }
    });

    doc.save('bilan_victime.pdf');  
        
});      
    
function InitOverviewDataTable_victime(){
  
  //initialize DataTables
  table_victime = $('#tableau_victime').DataTable({
      
      "autoWidth": false,
      "order": [[ 12, "desc" ]],
      "columnDefs": [ 
          {
            "targets": 0,
            "data": 'nom',
            "defaultContent": "",
              "width": "10%"
        },
          {
            "targets": 1,
            "data": 'prenom',
            "defaultContent": "",
            "width": "10%"
        },
          {
            "targets": 2,
            "data": 'identification',
            "defaultContent": ""
            
        },
          {
            "targets": 3,
            "data": 'date_naissance',
            "defaultContent": ""
            
        },
          {
            "targets": 4,
            "data": 'age',
            "defaultContent": ""
            
        },
          {
            "targets": 5,
            "data": 'sexe',
            "defaultContent": ""
            
        },
          {
            "targets": 6,
            "data": 'nationalite',
            "defaultContent": ""
            
        },
          {
            "targets": 7,
            "data": 'adresse',
            "defaultContent": "", 
              "width": "10%"
        },
          {
            "targets": 8,
            "data": 'commentaire',
            "defaultContent": ""
            
        },
          {
            "targets": 9,
            "data": 'horaires',
            "defaultContent": "",
              "width": "10%"
            
        },
          {
            "targets": 10,
            "data": 'type_intervention',
            "defaultContent": ""
            
        },
          {
            "targets": 11,
            "data": 'centre_accueil',
            "defaultContent": ""
            
        },
          {
            "targets": 12,
            "data": 'date_creation',
            "defaultContent": ""
            
        },
          {
            "targets": 13,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_supprimer'><img src='images/trash_recyclebin_empty_closed.png' width=20px height=20px></button>",
            className: "td_center"
        },
          {
            "targets": 14,
            "data": null,
              "orderable": false,
            "defaultContent": "<button id='button_modifier'><img src='images/icon_edit.png' width=20px height=20px></button>",
            className: "td_center"
        } ],
        "rowCallback": function( row, data, index ) {
            var horaires = data.json_horaires;

            if (horaires!=''){
                    
                var horaires_object = JSON.parse(horaires);

                var heure_pris_en_charge=horaires_object[0].heure_pris_en_charge;
                var heure_entree_pc=horaires_object[1].heure_entree_pc;
                var heure_sortie_pc=horaires_object[2].heure_sortie_pc;

                    if (heure_pris_en_charge=='' || (heure_entree_pc=='' && heure_sortie_pc=='')){
                        $('td', row).css('background-color', 'inherit');
                    }else{
                        if (heure_entree_pc!='' && heure_sortie_pc==''){
                            $('td', row).css('background-color', '#e36c54');
                        }else{
                             if (heure_entree_pc!='' && heure_sortie_pc!=''){
                                 $('td', row).css('background-color', '#53ab5b');
                             }
                        }
                    }
                /*if (statu === 'inactif') {
                    $('td', row).css('background-color', '#e36c54');
                }else if (statu === 'actif'){
                    $('td', row).css('background-color', '#53ab5b');
                }else{
                    
                }*/
            }
        },
      language: language_datatable
  });
    
    $('#tableau_victime tbody').on( 'click', '#button_supprimer', function (e) {
      
        e.stopPropagation();
        var data = table_victime.row( $(this).parents('tr') ).data();
        
        swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer cette victime ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            supprime_victime(data.c6);
        });
        
    } );
    $('#tableau_victime tbody').on( 'click', '#button_modifier', function (e) {
        e.stopPropagation();
        var data = table_victime.row( $(this).parents('tr') ).data();
        ouvre_page_modifier_victime(data,pass1,pass2,pass3);   
    } );
    
    
    actualise_liste_des_victimes();
}    
    
    
function actualise_liste_des_victimes(){
    
    jqxhr_activite = $.post(Global.APP_SERVER_URL+Global.REFRESH_LISTE_VICTIMES_URI,{ mon_code:Global.code_administrateur,id_activite_mission:pass2,activite_mission:pass3})

    .done(function(data, textStatus, jqXHR ) {

        data=data.replace('return_txt=','');
        
        //alert(data);
        
        if (data==="-1"){
            table = $('#tableau_victime').DataTable();
            table.clear();
            table.draw();
            return;
        }
        
        var trame=data.split("\n");

        var id= new Array();
        var nom = new Array();
        var prenom= new Array();
        var identification= new Array();
        var date_naissance= new Array();
        var age= new Array();
        var sexe= new Array();
        var nationalite= new Array();
        var adresse= new Array();
        var commentaire= new Array();
        var json_horaires= new Array();
        var type_intervention= new Array();
        var centre_accueil= new Array();
        
        var date_creation= new Array();
        

        data_table_list_des_victimes= new Array();

        for (i=0; i<trame.length;i++)
            {
                //alert(trame[i]);
                var temp=trame[i].split(">rezopcinline_wd<");
                
                // Vérifier que le tableau a assez d'éléments avant d'y accéder
                if (temp.length < 15) {
                    console.error('Format de données invalide pour la ligne ' + i + ': ' + trame[i]);
                    continue; // Ignorer cette ligne et passer à la suivante
                }
                
                id[i]=temp[0] || '';
                nom[i]=temp[1] || '';
                prenom[i]=temp[2] || '';
                identification[i]= temp[3] || '';
                date_naissance[i]= (temp[4] && typeof temp[4] === 'string') ? temp[4].substr(0, 10) : '';
                
                
                age[i]= temp[5] || '';
                if (temp[6]=='0'){
                    sexe[i]= 'Femme';
                }else{
                    sexe[i]= 'Homme';
                }
                
                nationalite[i]= temp[7] || '';
                adresse[i]= temp[8] || '';
                commentaire[i]= temp[9] || '';
                json_horaires[i]= temp[10] || '';
                type_intervention[i]= temp[12] || '';
                centre_accueil[i]= temp[13] || '';
                date_creation[i]=temp[14] || '';
                if (json_horaires[i]!=''){
                    
                    var horaires_object = JSON.parse(json_horaires[i]);
    
                    var heure_pris_en_charge=horaires_object[0].heure_pris_en_charge;
                    var heure_entree_pc=horaires_object[1].heure_entree_pc;
                    var heure_sortie_pc=horaires_object[2].heure_sortie_pc;
                   
                }else{
                    var heure_pris_en_charge='';
                    var heure_entree_pc='';
                    var heure_sortie_pc='';
                }
                var horaires='Pris en charge : '+ heure_pris_en_charge + '<br>';
                horaires=horaires + 'Entrée PC : '+ heure_entree_pc + '<br>';
                horaires=horaires + 'Sortie PC : '+ heure_sortie_pc + '<br>';
                
                data_table_list_des_victimes.push({nom:nom[i], prenom:prenom[i], identification:identification[i],date_naissance:date_naissance[i],age:age[i],sexe:sexe[i],nationalite:nationalite[i],adresse:adresse[i],commentaire:commentaire[i],horaires:horaires,json_horaires:json_horaires[i],type_intervention:type_intervention[i],centre_accueil:centre_accueil[i],date_creation:date_creation[i],c6:id[i]});
            }
        if (data_table_list_des_victimes.length>0){
            table = $('#tableau_victime').DataTable();
            table.clear();
            table.rows.add(data_table_list_des_victimes);
            table.draw();
            
        }else{
            table = $('#tableau_victime').DataTable();
            table.clear();
            table.draw();
        }
        actualise_table_invisible(data_table_list_des_victimes);    
    })
  .fail(function(jqXHR, textStatus, errorThrown) {
        table = $('#tableau_victime').DataTable();
            table.clear();
            table.draw();
     ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'actualiser la liste des victimes');   

  })
  .always(function() {

  })
  ;
    
}
    
function actualise_table_invisible(data_table_list_des_victimes){
    
    for (i=0;i<data_table_list_des_victimes.length;i++){
        
        var adresse=data_table_list_des_victimes[i].adresse;
        adresse=adresse.replace(/<br>/g, '\n');
        data_table_list_des_victimes[i].adresse=adresse;
        
        var commentaire=data_table_list_des_victimes[i].commentaire;
        commentaire=commentaire.replace(/<br>/g, '\n');
        data_table_list_des_victimes[i].commentaire=commentaire;
        
        var type_intervention=data_table_list_des_victimes[i].type_intervention;
        type_intervention=type_intervention.replace(/<br>/g, '\n');
        data_table_list_des_victimes[i].type_intervention=type_intervention;
        
        var centre_accueil=data_table_list_des_victimes[i].centre_accueil;
        centre_accueil=centre_accueil.replace(/<br>/g, '\n');
        data_table_list_des_victimes[i].centre_accueil=centre_accueil;
        
        var horaires=data_table_list_des_victimes[i].horaires;
        horaires=horaires.replace(/<br>/g, '\n');
        data_table_list_des_victimes[i].horaires=horaires;
    }
    
    data_table_pdf=data_table_list_des_victimes;
    
}    
    
    
function supprime_victime(id_victime_a_supprimer){
    
    var $data={
        mon_code:Global.code_administrateur, 
        id_de_la_victime:id_victime_a_supprimer
    }

    var jqxhr = $.post(Global.APP_SERVER_URL+Global.DELETE_VICTIME_URI,$data)

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
            swal("Succès","La victime a bien étée supprimée de la liste.","success");
            actualise_liste_des_victimes();
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Suppression impossible...'); 
      
  })
  .always(function() {

  })
  ;        
}
    
    
    $('#id_view_voir_bilan').on('remove',function(){ 
        
        page_bilan_fermer=true;
        
        jqxhr_activite.abort();
        table = $('#tableau_victime').DataTable();
            table.clear();
            table.draw();
    });
    
    page_bilan_fermer=false;
    
    InitOverviewDataTable_victime();
   
    
});
    
</script>