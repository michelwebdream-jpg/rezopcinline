<?php $burl=$_POST['burl']; $pass1=$_POST['pass1'];$pass2=$_POST['pass2'];$pass3=$_POST['pass3'];?>

<div id="id_view_voir_main_courante">
    <?php
    if ($pass3=='activite'){
        $titre="Main courante de l'activité / DPS : " . $pass1;
    }else if ($pass3=='mission'){
        $titre="Main courante de la mission : " . $pass1;
    }else{
        $titre="";
    }
    ?>
<h1 style=" overflow: hidden; float: left;margin-right: 10px;"><?php echo $titre; ?></h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    

<div class="separator"></div>
    
<hr />

    <div id="report_main_courante" ></div>
    
    <hr />
    
    <div style="float:right;display: flex;align-items: center;">
        <a href ="#" id="bouton_export_pdf_main_courante" class="bouton_fermer" style="margin-right:10px;"> Exporter au format PDF </a>
        <a href ="#" id="bouton_fermer_non_modal" class="bouton_fermer"> Fermer </a>
    </div>
    
    
    <div id="content_info_generales" style="display:none">
    
        <h2>Informations générales</h2>
        
        <p id="nom_activite_pdf"><i>Nom de l'activité :</i> </p>
        <p id="responsable_activite_pdf"><i>Nom du responsable PC :</i> </p>
        <p id="adresse_activite_pdf"><i>Lieu :</i> </p>
        <p id="nature_activite_pdf"><i>Nature du dispositif :</i> </p>
        <p id="remarque_activite_pdf"><i>Consignes particulières initiales - Remarques - Informations diverses :</i> </p>
        <p id="date_activite_pdf"><i>Date de l'activité / DPS :</i> </p>
        <p id="heure_lancement_activite_pdf"><i>Heure de prise de poste - Lancement de l'activité / DPS :</i> </p>
        <p id="heure_arret_activite_pdf"><i>Heure de fermeture dispositif :</i> </p>
               
    </div>
    <div id="content_synthese" style="display:none">
    
        <p id="nombre_intervenant_pdf"><i>Nombre d'intervenants :</i> </p>
        <p id="intervenant_pdf"><i>Intervenants :</i> </p>
        <p id="nombre_de_victime_pdf"><i>Nombre de victimes :</i> </p>
        <p id="nombre_depart_intervention_pdf"><i>Nombre de départs en intervention :</i> </p>
        <p id="nombre_urgence_intervention_pdf"><i>Nombre d'urgences' :</i> </p>
        
               
    </div>
    
<script>
    
$(document).ready( function () {
    
    
var pass1="<?php echo $pass1; ?>";
var pass2="<?php echo $pass2; ?>";
var pass3="<?php echo $pass3; ?>";
    
var titre= "<?php echo $titre; ?>";

var doc;
var marge_gauche=5;
var marge_haut=5;
var hauteur_titre1=20;
var hauteur_titre2=30;    
var centeredText = function(text, y, font_size_max) {
        
        var font_var=font_size_max;
        var fini=false;
        
        while (!fini){
            doc.setFontSize(font_var);
            var textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            if (textWidth<doc.internal.pageSize.getWidth()-4*marge_gauche){
                fini=true;
            }
            font_var=font_var-1;
            if (font_var<2){
                fini=true
            }
        }
         var textOffset = (doc.internal.pageSize.getWidth() - textWidth) / 2;
        doc.text(textOffset, y, text);
    }    
var donnee_pour_historique=new Array();
var data_table_list_des_victimes= new Array();
var heure_impression=$('#div_horloge').text();  
var evenement_array= new Array();
var nb_depart=0;
var nb_urgence=0;
var nb_victime=0;
var data_table_list_des_intervenants= new Array();
    
get_activite_with_id();
    
function generate_pdf(){
    
    doc = new jsPDF("p", "mm", "a4");
    
    add_border_footer(true);
    
    // Titre
    centeredText("Main courante",16,20);
    doc.setFontType("bold");
    centeredText("Activité / DPS : "+pass1,42,35);
    
    // Date, Lieu, Nature
    
    var marge_gauche_du_texte=2*marge_gauche+10;
    var start_y=marge_haut+hauteur_titre1+hauteur_titre2+10;
    
    doc.fromHTML($('#content_info_generales').html(), marge_gauche_du_texte, start_y, {
        'width': 170
    });
    

      
    //add page evenement
    
    doc.addPage();
    add_border_footer(false);
    centeredText("Liste des évènements",16,20);
    
    
    if (donnee_pour_historique.length+data_table_list_des_victimes.length==0){
        centeredText("Aucun évènement.",doc.internal.pageSize.getHeight()/2,15);
    }else{

        genere_tableau_evenement();
        
    }
    
    //add page victime
    
    doc.addPage('a4', 'l');
    add_border_footer(false);
    centeredText("Liste des victimes",16,20);
    if (data_table_list_des_victimes.length==0){
        centeredText("Aucune victime déclarée.",doc.internal.pageSize.getHeight()/2,15);
    }else{
        genere_tableau_victime();
    }

    //add page synthese
    doc.addPage('a4', 'p');
    add_border_footer(false);
    centeredText("Synthèse",16,20);
        
    
    doc.fromHTML($('#content_synthese').html(), marge_gauche_du_texte, start_y, {
        'width': 170
    });
    
    // output
    
    var data = doc.output('dataurlstring');
    $('#report_main_courante').html('<iframe src="'+data+'" style="width:100%;height:550px"></iframe>');
    
}
   
$("#bouton_export_pdf_main_courante").on("click", function() {
    doc.save('main_courante.pdf');  
        
});      
    
function get_activite_with_id(){
    
        
        
    jqxhr_activite = $.post(Global.APP_SERVER_URL+Global.GET_ACTIVITE_URI,{ mon_code:Global.code_administrateur,id_activite:pass2})

    .done(function(data, textStatus, jqXHR ) {

        
        data=data.replace('return_txt=','');

        var qte= "";
        var titre = "";
        var membres= "";
        var date= "";
        var id= "";
        var nom_responsable= "";
        var adresse= "";
        var remarque= "";
        var nature_activite= "";
        
        if (data!=="-1"){
            var temp=data.split("><");
            qte=temp[0];
            titre=temp[1];
            membres=temp[2];
            date=temp[3];
            id=temp[4];
            nom_responsable=temp[5];
            adresse=temp[6];
            remarque=temp[7];
            nature_activite=temp[8];
        }
        
        
        $("#nom_activite_pdf").append('<strong>'+titre+'</strong>');
        $("#adresse_activite_pdf").append('<h2></h2><strong>'+adresse+'</strong>');
        
        $("#nature_activite_pdf").append('<h2></h2><strong>'+nature_activite+'</strong>');
        $("#responsable_activite_pdf").append('<strong>'+nom_responsable+'</strong>');
        $("#remarque_activite_pdf").append('<h2></h2><strong>'+remarque+'</strong>');
        
        $("#nombre_intervenant_pdf").append('<strong>'+qte+'</strong>');
        
        
        get_user_from_ids(membres);
        
        
    })
  .fail(function(jqXHR, textStatus, errorThrown) {
        
     ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'éditer la main courante.');   

  })
  .always(function() {

  })
  ;
    
}    
    
function add_border_footer(with_title){
    //border
    doc.rect(marge_gauche, marge_haut, doc.internal.pageSize.getWidth() - 2*marge_gauche, doc.internal.pageSize.getHeight() - 2*marge_haut, 'S');
    doc.rect(marge_gauche, doc.internal.pageSize.getHeight()-marge_haut-10, doc.internal.pageSize.getWidth() - 2*marge_gauche, 10, 'S');
    doc.rect(marge_gauche, marge_haut, doc.internal.pageSize.getWidth() - 2*marge_gauche, hauteur_titre1, 'S');
    
    if (with_title){
        
        doc.rect(marge_gauche, marge_haut+hauteur_titre1, doc.internal.pageSize.getWidth() - 2*marge_gauche, hauteur_titre2, 'S');
    }
     
    // bas de page
    doc.setFontType("normal");
    doc.setFontSize("3");
    centeredText("Page "+doc.internal.getNumberOfPages(),doc.internal.pageSize.getHeight()-marge_haut-6,10);
    centeredText("Main courante : "+ pass1 +" - Imprimé le "+heure_impression+" - REZO+ PC Inline V3.0",doc.internal.pageSize.getHeight()-marge_haut-2,10);
}
    
    
function lit_historique_pour_main_courante(){
   
    donnee_pour_historique=new Array();
    
    var $data={
            mon_code:Global.code_administrateur,
            activite:pass2
        }
    
    var jqxhr_lit_historique = $.post(Global.APP_SERVER_URL+Global.LIT_HISTORIQUE_WITH_ID_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        
        
        if (buf==="-1")
        {
            return;  

        }else if (buf==="")
        {
				return;  
        }
        else
        {
                

                buf=buf.replace(/\\'/g, "'");
				buf=buf.replace(/\\\\n/g, "retourchariorezoozer");
				var trame=buf.split("\\n");
				
				for (i=1;i<trame.length;i++){
						
                    trame[i]=trame[i].replace(/,/, "separatorrezorozero");
						var trame2=trame[i].split("separatorrezorozero");
						trame2[1]=trame2[1].replace(/retourchariorezoozer/g, "\r" );
						donnee_pour_historique.push({date:trame2[0], evenement:trame2[1]});
					}
        
        for (i=0;i<donnee_pour_historique.length;i++){
     
            var string_date=donnee_pour_historique[i].date;
            var string_date_array=string_date.split(' - ')
            var heure=string_date_array[1];
            if (!heure){
                heure='00:00:00';
            }
            var date_array=string_date_array[0].split(' ');
            var jour=date_array[1];
            jour=pad(jour,2);
            var mois=date_array[2];
            var mois_def = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
            var mois_index=jQuery.inArray(mois,mois_def)+1;
            mois_index=pad(mois_index,2);
            var annee=date_array[3];
            
            var date_finale=jour+'-'+mois_index+'-'+annee+' '+heure;
            donnee_pour_historique[i].date=date_finale;
        }    
            
 		        
      }})
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible d\'établir la main courante.');  
     
  })
  .always(function() {
    lit_bilan_victime();  
  })
  ;
	
}    
    
  
function lit_bilan_victime(){
    
    data_table_list_des_victimes= new Array();
    
    jqxhr_activite = $.post(Global.APP_SERVER_URL+Global.REFRESH_LISTE_VICTIMES_URI,{ mon_code:Global.code_administrateur,id_activite_mission:pass2,activite_mission:pass3})

    .done(function(data, textStatus, jqXHR ) {

        data=data.replace('return_txt=','');
        
        
        //alert(data);
        
        if (data==="-1"){
            
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
        var bilan_circonstanciel=new Array();
        var type_intervention= new Array();
        var centre_accueil= new Array();
        
        var date_creation= new Array();
        

        

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
                bilan_circonstanciel[i]= temp[11] || '';
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
                
                data_table_list_des_victimes.push({nom:nom[i], prenom:prenom[i], identification:identification[i],date_naissance:date_naissance[i],age:age[i],sexe:sexe[i],nationalite:nationalite[i],adresse:adresse[i],commentaire:commentaire[i],horaires:horaires,json_horaires:json_horaires[i],bilan_circonstanciel:bilan_circonstanciel[i],type_intervention:type_intervention[i],centre_accueil:centre_accueil[i],date_creation:date_creation[i],c6:id[i]});
            }
        
        actualise_table_invisible(data_table_list_des_victimes);    
        
          nb_victime=data_table_list_des_victimes.length;
    })
  .fail(function(jqXHR, textStatus, errorThrown) {
        ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible de créer la main courante');   

  })
  .always(function() {
        
        calcul_des_variables();
 
  })
  ;
    
}
    
function actualise_table_invisible(dt){
    
    for (i=0;i<dt.length;i++){
        
        var adresse=dt[i].adresse;
        adresse=adresse.replace(/<br>/g, '\n');
        dt[i].adresse=adresse;
        
        var commentaire=dt[i].commentaire;
        commentaire=commentaire.replace(/<br>/g, '\n');
        dt[i].commentaire=commentaire;
        
        var bilan_circonstanciel=dt[i].bilan_circonstanciel;
        bilan_circonstanciel=bilan_circonstanciel.replace(/<br>/g, '\n');
        dt[i].bilan_circonstanciel=bilan_circonstanciel;
        
        var type_intervention=dt[i].type_intervention;
        type_intervention=type_intervention.replace(/<br>/g, '\n');
        dt[i].type_intervention=type_intervention;
        
        var centre_accueil=dt[i].centre_accueil;
        centre_accueil=centre_accueil.replace(/<br>/g, '\n');
        dt[i].centre_accueil=centre_accueil;
        
        var horaires=dt[i].horaires;
        horaires=horaires.replace(/<br>/g, '\n');
        dt[i].horaires=horaires;
    }
    
    data_table_list_des_victimes=dt;
    
}   
    
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}    
    
function get_user_from_ids(les_codes){
    
     jqxhr_detail_activite = $.post(Global.APP_SERVER_URL+Global.GET_USER_FROM_IDS_URI,{ liste_des_codes:les_codes})

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf=="-1")
        {
            return; 

        }else if (buf=="")
        {
				return; 
        }
        else
        {
                 var trame2=buf.split("\n");


                var code2= new Array(trame2.length);
                var nom2= new Array(trame2.length);
                var prenom2= new Array(trame2.length);
                var indicatif2= new Array(trame2.length);

                data_table_list_des_intervenants= new Array();
                for (i=0; i<trame2.length;i++)
                {
                    var temp2=trame2[i].split("><");
                    code2[i]=temp2[0];
                    
                    nom2[i]=temp2[1];
                    prenom2[i]=temp2[2];
                    indicatif2[i]=temp2[3];

                    data_table_list_des_intervenants.push({nom:nom2[i] +" " + prenom2[i], code:code2[i], indicatif:indicatif2[i]});
                }

            var sortie_identite_array=new Array();
            for (i=0; i<data_table_list_des_intervenants.length;i++)
            {
                sortie_identite_array.push(data_table_list_des_intervenants[i].nom+' (indicatif : '+data_table_list_des_intervenants[i].indicatif+' - code REZO+ : '+ data_table_list_des_intervenants[i].code+')');
            }
            var sortie_identite=sortie_identite_array.join('<h2> </h2>');
            $("#intervenant_pdf").append('<strong><h2> </h2>'+sortie_identite+'</strong>');
            
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      //ouvre_alerte('Erreur réseau !<br />Un problème réseau est survenu.<br />Impossible d\'afficher la main courante.');  
     
  })
  .always(function() {
    lit_historique_pour_main_courante();
  })
  ;
}    
  
function genere_tableau_evenement(){
    
    
    
    /*for (i=0;i<liste_des_dates_activite.length;i++){
        console.log(liste_des_dates_activite[i]);
    }*/
    
    var columns = [
        {title: "Date", dataKey: "date"},
        {title: "Évèvements", dataKey: "evenement"}, 
        {title: "Type", dataKey: "type_evenement"},
        
    ];

    var rows = evenement_array;
    
    doc.autoTable(columns, rows, {
        theme: 'striped',
        styles: { overflow:'linebreak',columnWidth: 'auto'},
        
        // Properties
        fontSize: 8,

        startY: false, // false (indicates margin top value) or a number
        margin: {top: marge_haut+hauteur_titre1,left:marge_gauche}, // a number, array or object
        pageBreak: 'auto', // 'auto', 'avoid' or 'always'
        tableWidth: doc.internal.pageSize.getWidth() - 2*marge_gauche, // 'auto', 'wrap' or a number, 
        showHeader: 'everyPage', // 'everyPage', 'firstPage', 'never',
        tableLineColor: 200, // number, array (see color section below)
        tableLineWidth: 0,
        addPageContent: function(data) {

            add_border_footer(false);
            centeredText("Liste des évènements",16,20);
        }
    });
}    
    
function genere_tableau_victime(){
    
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
        {title: "Bilan circonstanciel", dataKey: "bilan_circonstanciel"},
        {title: "Type d'intervention", dataKey: "type_intervention"},
        {title: "Centre d'accueil", dataKey: "centre_accueil"},
        {title: "Date de création", dataKey: "date_creation"},
    ];

    var rows = data_table_list_des_victimes;
    

    doc.autoTable(columns, rows, {
        theme: 'striped',
        styles: { overflow:'linebreak',columnWidth: 'auto'},
        columnStyles: {nom:{columnWidth: 50/2.8},prenom:{columnWidth: 50/2.8},adresse: {columnWidth: 70/2.8},age:{columnWidth: 'wrap'},sexe:{columnWidth: 'wrap'},date_naissance:{columnWidth: 'wrap'},nationalite:{columnWidth: 'wrap'},identification:{columnWidth: 'wrap'}},
        // Properties
        fontSize: 8,

        startY: false, // false (indicates margin top value) or a number
        margin: {top: marge_haut+hauteur_titre1,left:marge_gauche, right:marge_gauche}, // a number, array or object
        pageBreak: 'auto', // 'auto', 'avoid' or 'always'
        //tableWidth: doc.internal.pageSize.getWidth() - 2*marge_gauche,
        showHeader: 'everyPage', // 'everyPage', 'firstPage', 'never',
        tableLineColor: 200, // number, array (see color section below)
        tableLineWidth: 0,
        addPageContent: function(data) {

            add_border_footer(false);
            centeredText("Liste des victimes",16,20);
        }
    });
}        
       
function calcul_des_variables(){
    
    evenement_array= new Array();
    
    for (i=0;i<donnee_pour_historique.length;i++){
        evenement_array.push({date:donnee_pour_historique[i].date, evenement:donnee_pour_historique[i].evenement, type_evenement:'Info activite'});
    }
    for (i=0;i<data_table_list_des_victimes.length;i++){
        var string_ev="Victime déclarée le "+data_table_list_des_victimes[i].date_creation+". Horaires de pris en charge :\n"+data_table_list_des_victimes[i].horaires+"\nNom : "+data_table_list_des_victimes[i].nom + " " + data_table_list_des_victimes[i].prenom
        
        evenement_array.push({date:data_table_list_des_victimes[i].date_creation, evenement:string_ev, type_evenement:'Victime'});
    }
    
    //alert(moment(evenement_array[0].date, "DD-MM-YYYY HH:mm:ss").format());
    
    evenement_array.sort(function(a,b){
    // Turn your strings into dates, and then subtract them
    // to get a value that is either negative, positive, or zero.
    return new Date(moment(b.date, "DD-MM-YYYY HH:mm:ss").format()) - new Date(moment(a.date, "DD-MM-YYYY HH:mm:ss").format());
    });
    
    /*for (i=0;i<evenement_array.length;i++){
        console.log(evenement_array[i].date+ ' - '+ evenement_array[i].evenement+'-'+evenement_array[i].type_evenement);
    }*/
    
    var liste_des_dates_activite=new Array();
    
    for (i=0;i<evenement_array.length;i++){
        var trouve=false;
        var check_date_complet=evenement_array[i].date;
        var check_date_array=check_date_complet.split(' ');
        
        var la_date=check_date_array[0];
        
        for (j=0;j<liste_des_dates_activite.length;j++){
            if (la_date===liste_des_dates_activite[j]){
                trouve=true;
                break;
            }
        }
        if (trouve==false){
            liste_des_dates_activite.push(la_date);
        }
    }
    
    var string_date_activite=liste_des_dates_activite.join(', ');
    $("#date_activite_pdf").append('<strong>'+string_date_activite+'</strong>');
    
    
    var liste_des_lancement_d_activite=new Array();
    
    for (i=0;i<evenement_array.length;i++){
        var evenement=evenement_array[i].evenement;
        if (evenement.indexOf('Lancement')==0){
            
            var s_date=evenement_array[i].date
            s_date=s_date.split(' ');
            liste_des_lancement_d_activite.push('le '+s_date[0]+' à '+s_date[1]);
        }
    }
    
    var liste_string=liste_des_lancement_d_activite.join(', ');
    
    $("#heure_lancement_activite_pdf").append('<strong>'+liste_string+'</strong>');
    
    
    var liste_des_arret_d_activite=new Array();
    
    for (i=0;i<evenement_array.length;i++){
        var evenement=evenement_array[i].evenement;
        if (evenement.indexOf('Arrêt')==0){
            
            var s_date=evenement_array[i].date
            s_date=s_date.split(' ');
            liste_des_arret_d_activite.push('le '+s_date[0]+' à '+s_date[1]);
        }
    }
    
    var liste_string_arret=liste_des_arret_d_activite.join(', ');
    
    $("#heure_arret_activite_pdf").append('<strong>'+liste_string_arret+'</strong>');
    
    nb_depart=0;
    
    for (i=0;i<evenement_array.length;i++){
        var evenement=evenement_array[i].evenement;
        if (evenement.indexOf(': Départ')>-1){
            
            nb_depart++;
        }
    }
    
    nb_urgence=0;
    
    for (i=0;i<evenement_array.length;i++){
        var evenement=evenement_array[i].evenement;
        if (evenement.indexOf(': URGENCE')>-1){
            
            nb_urgence++;
        }
    }
    
    $("#nombre_depart_intervention_pdf").append('<strong>'+nb_depart+'</strong>');
    $("#nombre_urgence_intervention_pdf").append('<strong>'+nb_urgence+'</strong>');
        
    $("#nombre_de_victime_pdf").append('<strong>'+nb_victime+'</strong>');
    
    
    generate_pdf();
}
             
    
});
   
    

</script>