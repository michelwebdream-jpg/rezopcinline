<?php $burl=$_POST['burl']; ?>


<div id="id_view_historique">
<h2 style=" overflow: hidden; float: left;margin-top: 5px;">Historique : <span id="titre_page_historique"></span></h2>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_page_historique" class="bouton_fermer"> Fermer </a>
</div>

<div class="separator"></div>
<hr />

<table id="table_historique" class="display" cellspacing="0">
    <thead>
    <tr>
        <th>N°</th>
        <th>Date</th>
        <th>Evénements</th>
    </tr>
    </thead>
</table>

<hr />
    

</div>
<div id="div_bouton_ajouter_evenement_historique" style="text-align: center;"><a href ="#" id="bouton_ajouter_evenement_historique" class="bouton_fermer"> + Ajouter un événement </a><hr /></div>
    
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_effacer_historique" class="bouton_fermer"> Effacer l'historique </a>
</div>    
<div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_sauver_historique" class="bouton_fermer" style="margin-right:10px;"> Exporter au format CSV </a>
</div> 
<div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_export_pdf_historique" class="bouton_fermer" style="margin-right:10px;"> Exporter au format PDF </a>
</div> 

<div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_mail_historique" class="bouton_fermer" style="margin-right:10px;"> Envoyer par e-mail </a>
</div> 
<div class="separator"></div>
<div id="container_mail_hisrotique" style="display:none";>
    <hr />
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_mail_historique" class="bouton_fermer"> Fermer </a>
    </div>    
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_envoyer_mail_historique" class="bouton_fermer" style="margin-right:10px;"> Envoyer </a>
    </div> 
    <input type="text" name="input_destinataire_mail_historique" id="input_destinataire_mail_historique" value="" placeholder="ex:email@mail.fr" style="float:right;display: flex;align-items: center;margin-right:10px;"/>
    <label style="float:right;display: flex;align-items: center;margin-top:4px;" for="input_destinataire_mail_historique">Destinataire : </label>
    
<div class="separator"></div>
<div id="message_resultat_envoie_mail" style="text-align:center;"></div>
</div>    
<script>
        
var table_historique;    
    
$(document).ready( function () {
    
    $("#bouton_export_pdf_historique").on("click", function() {
        export_pdf();
    });
function export_pdf(){
    
    var columns = [
    {title: "N°", dataKey: "numero"},
    {title: "Date", dataKey: "date"}, 
    {title: "Evenement", dataKey: "evenement"},
];
    
    var data_table_historique=new Array();
    
    table_historique.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var data = this.data();
        data_table_historique.push({numero:data.c_id, date:data.c1,evenement:data.c2});
    } );
    
    var nom_activite_mission=$('#titre_page_historique').html();
    var heure_impression=$('#div_horloge').text();
    
    var doc = new jsPDF('landscape', 'pt');
    
    //var elem = document.getElementById("table_historique");
    //var res = doc.autoTableHtmlToJson(elem);
    doc.autoTable(columns, data_table_historique, {
    theme: 'striped',
    styles: {columnWidth: 'auto'},
    columnStyles: {},
    // Properties
    fontSize: 10,
    overflow:'linebreak',
    startY: false, // false (indicates margin top value) or a number
    margin: {top: 60}, // a number, array or object
    pageBreak: 'auto', // 'auto', 'avoid' or 'always'
    tableWidth: 'auto', // 'auto', 'wrap' or a number, 
    showHeader: 'everyPage', // 'everyPage', 'firstPage', 'never',
    tableLineColor: 200, // number, array (see color section below)
    tableLineWidth: 0,
    addPageContent: function(data) {
    	
        doc.text("Historique : " +nom_activite_mission, 40, 35);
        doc.setFontSize(10);
        doc.text("Date d'impression : " + heure_impression, 40, 45);
    }});
     doc.save('historique.pdf');
}
function envoyer_mail(destinataire){
    
    $("#message_resultat_envoie_mail").empty();
    $("#message_resultat_envoie_mail").append('Envoie en cours...');
    
    var nom_activite_mission=$('#titre_page_historique').html();
    var email_destinataire=destinataire;
    
    var message="";
    table_historique.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var data = this.data();
        message+=data.c1 + " - " + data.c2 + "<br />";
    } );
    
    
    
    if (email_destinataire == '') {
        swal("Erreur","L'adresse email doit être renseignée !","error");
    } else {
        // Returns successful data submission message when the entered information is stored in database.
    $.post(base_url+"php/contact_form.php", {
        email1: email_destinataire,
        message1: message,
        nom_activite_mission: nom_activite_mission
        }, function(data) {
        $("#message_resultat_envoie_mail").empty();
        $("#message_resultat_envoie_mail").append('<h2>'+data+'</h2>'); // Append returned message to message paragraph.
    });
    }
}
    
function InitOverviewDataTable_historique(){
  
  //initialize DataTables
  table_historique = $('#table_historique').DataTable({
      
      "autoWidth": false,
      //"ordering": false,
      "order": [[ 0, "desc" ]],
      "columnDefs": [ 
          {
            "targets": 0,
            "data": 'c_id',
            "defaultContent": "",
              "orderable": true
        },
          {
            "targets": 1,
            "data": 'c1',
            "defaultContent": "",
              "orderable": false
        },
          {
            "targets": 2,
            "data": 'c2',
            "defaultContent": "",
              "orderable": false
        }],
      language: language_datatable
  });
}
    
    $('#id_view_activite').on('remove',function(){ 
        table_historique.clear();
        table_historique.draw();
    });
    
    
    $('#bouton_mail_historique').click(function() {
        
    	$('#container_mail_hisrotique').slideDown('fast');
		
  	});
    $('#bouton_fermer_mail_historique').click(function() {
        
    	$('#container_mail_hisrotique').slideUp('fast');
		
  	});
    
    
    $('#bouton_envoyer_mail_historique').click(function() {
        
    	envoyer_mail($('#input_destinataire_mail_historique').val());
		
  	});
    
    InitOverviewDataTable_historique();
    
});
    
</script>