<?php $burl=$_POST['burl']; $pass1=$_POST['pass1'];$pass2=$_POST['pass2'];$pass3=$_POST['pass3'];$edition=$_POST['edition'];$donnees_victime=$_POST['donnees_victime']?>

<div id="id_view_declarer_victime">
<h1 style=" overflow: hidden; float: left;">Déclarer une victime</h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
</div>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_non_modal" class="bouton_fermer"> Fermer </a>
</div>

<div class="separator"></div>
<hr />


<div class="formulaire_saisie_victime">
    
    <div class="column_victime1">
    
        <h2>Informations sur la victime</h2>
        <p>
            <label for="input_nom_victime">Nom (Obligatoire) : </label>
            <input type="text" name="input_nom_victime" id="input_nom_victime" value=""/>
        </p>
        <p>
        <label for="input_prenom_victime">Prénom : </label>
        <input type="text" name="input_prenom_victime" id="input_prenom_victime" value=""/>
        </p>
        <p>
            <label for="input_identification_victime">Identification par marquage : </label>
            <input type="text" name="input_identification_victime" id="input_identification_victime" value=""/>    
        </p>
        <p>
            <label for="input_date_naissance_victime">Date de naissance : </label>
            <input type="text" name="input_date_naissance_victime" id="input_date_naissance_victime" value=""/>   
        </p>    
        <p>
            <label for="input_age_victime">Age : </label>
            <input type="text" name="input_age_victime" id="input_age_victime" value=""/>
        </p>
        <p>
            <label for="choix_sexe_victime"  >Sexe : </label>

        <select id="combobox_choix_sexe_victime">
            <option value="0"> Femme </option>
            <option value="1"> Homme </option>
            </select>

        </p>
        <p>
            <label for="input_nationalite_victime">Nationalité : </label>
            <input type="text" name="input_nationalite_victime" id="input_nationalite_victime" value=""/>
        </p>
        <p>
            <label for="input_adresse_victime">Adresse : </label>
            <textarea name="input_adresse_victime" id="input_adresse_victime" value="" cols="40" rows="5"/>
        </p>    
        <p>
            <label for="input_commentaire_victime">Commentaire : </label>
            <textarea name="input_commentaire_victime" id="input_commentaire_victime" value="" cols="40" rows="5"/>
        </p>
      
    </div>
    <div class="column_victime2">
        <h2>Informations sur l'intervention</h2>
        <p>
            <label for="input_heure_pris_en_charge">Heure de prise en charge : </label>
            <input id="input_heure_pris_en_charge" class="timepicker"/>
        </p>
        <p>
            <label for="input_heure_entree">Heure d'entrée au PC : </label>
            <input id="input_heure_entree" class="timepicker"/>
        </p>
        <p>
            <label for="input_heure_sortie">Heure de sortie du PC : </label>
            <input id="input_heure_sortie" class="timepicker"/>
        </p>
        <p>
            <label for="input_bilan_circonstanciel">Bilan circonstanciel : </label>
            <textarea name="input_bilan_circonstanciel" id="input_bilan_circonstanciel" value="" cols="40" rows="5"/>
        </p>
        <p>
            <label for="input_intervention_victime">Type d'intervention réalisée : </label>
            <textarea name="input_intervention_victime" id="input_intervention_victime" value="" cols="40" rows="5"/>
        </p>
        <p>
            <label for="input_centre_accueil">Centre d'accueil (le cas échéant) : </label>
            <textarea name="input_centre_accueil" id="input_centre_accueil" value="" cols="40" rows="5"/>
        </p>
    
   </div>
</div>
<div class="separator"></div>
    <hr />
    <p style="display:inline-block !important;width:100%!important;text-align: center;"><a href ="#" id="bouton_ajouter_victime" class="bouton_fermer"> Ajouter la victime dans le bilan </a></p>
    
    
<script>
        



    
$(document).ready( function () {
    
    
var pass1="<?php echo $pass1; ?>";
var pass2="<?php echo $pass2; ?>";
var pass3="<?php echo $pass3; ?>";

var edition="<?php echo $edition; ?>";    
var donnees_victime=<?php echo json_encode($donnees_victime); ?>; 
    
var datepic = $( "#input_date_naissance_victime" ).datepicker({
    altField: "#datepicker",
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'dd/mm/yy',
    minDate: new Date(1900, 1 - 1, 1),
    maxDate: '0',
    yearRange: '1900:c',
    changeYear: true
});

var time_pic_entree=$('#input_heure_entree').timepicker({
    timeFormat: 'HH:mm',
    interval: 1,
    minTime: '0',
    maxTime: '23',
    defaultTime: '',
    startTime: '0',
    dynamic: true,
    dropdown: true,
    scrollbar: true
});
var time_pic_sortie=$('#input_heure_sortie').timepicker({
    timeFormat: 'HH:mm',
    interval: 1,
    minTime: '0',
    maxTime: '23',
    defaultTime: '',
    startTime: '0',
    dynamic: true,
    dropdown: true,
    scrollbar: true
});    
var time_pic_sortie=$('#input_heure_pris_en_charge').timepicker({
    timeFormat: 'HH:mm',
    interval: 1,
    minTime: '0',
    maxTime: '23',
    defaultTime: '',
    startTime: '0',
    dynamic: true,
    dropdown: true,
    scrollbar: true
});  

$('#input_heure_pris_en_charge').on('click', function() {
        $('#input_heure_pris_en_charge').timepicker('setTime', new Date());
});
$('#input_heure_entree').on('click', function() {
        $('#input_heure_entree').timepicker('setTime', new Date());
});
$('#input_heure_sortie').on('click', function() {
        $('#input_heure_sortie').timepicker('setTime', new Date());
});
    
    
$("#input_date_naissance_victime" ).datepicker("option", "onSelect", function(dateText, inst) {
   var dob = $(this).datepicker('getDate');
    var age = GetAge(dob);
    $( "#input_age_victime" ).val(age);
});    
    
    
    
$("#bouton_ajouter_victime").on("click", function() {
        if (edition=='0'){
            ajoute_victime();
        }else if (edition=='1'){
            update_victime();
        }
        
    });  
    
function ajoute_victime(){
    
    var idactivite='';
    var idmission='';
    
    if (pass3=='activite'){
        idactivite=pass2;
        idmission='';
    }else if (pass3=='mission'){
        idactivite='';
        idmission=pass2;
    }else{
        return;
    }
    
    var nom_find=$("#input_nom_victime").val();
    var prenom_find=$("#input_prenom_victime").val();
    var identification_find=$("#input_identification_victime").val();
    var date_naissance_find=$("#input_date_naissance_victime").val();
    var age_find=$("#input_age_victime").val();
    var sexe_find=$( "#combobox_choix_sexe_victime").find(":selected").val();
    var nationalite_find=$("#input_nationalite_victime").val();
    var adresse_find=$("#input_adresse_victime").val();
    var commentaire_find=$("#input_commentaire_victime").val();
    
    var heure_pris_en_charge_find=$("#input_heure_pris_en_charge").val();
    var heure_entree_pc_find=$("#input_heure_entree").val();
    var heure_sortie_pc_find=$("#input_heure_sortie").val();
    
    var array_heure=new Array();
    array_heure.push({heure_pris_en_charge:heure_pris_en_charge_find});
    array_heure.push({heure_entree_pc:heure_entree_pc_find});
    array_heure.push({heure_sortie_pc:heure_sortie_pc_find});
    
    var Json_horaires=JSON.stringify(array_heure);
    //alert(Json_horaires);
    //var as = JSON.parse(Json_horaires);
    //alert(as[0].heure_pris_en_charge);
    var bilan_circonstanciel=$("#input_bilan_circonstanciel").val();
    var interventioin_victime_find=$("#input_intervention_victime").val();
    var centre_accueil_find=$("#input_centre_accueil").val();
    
    if (nom_find==''){
        swal({   title: "ATTENTION !",   text: "Vous devez renseigner le nom de la victime avat de sauvegarder.",   type: "warning",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok", closeOnConfirm: true }, function(){   
            
        });
        return;
    }
     
    var $data={
        code:Global.code_administrateur, 
        id_activite:idactivite,
        id_mission:idmission,
        nom:nom_find,
        prenom:prenom_find,
        identification:identification_find,
        date_naissance:date_naissance_find,
        age:age_find,
        sexe:sexe_find,
        nationalite:nationalite_find,
        adresse:adresse_find,
        commentaire:commentaire_find,
        json_horaires:Json_horaires,
        bilan_circonstanciel:bilan_circonstanciel,
        intervention_victime:interventioin_victime_find,
        centre_accueil:centre_accueil_find
    }

    //alert(Global.AJOUTE_VICTIME_BILAN_URI + ' - ' + $data['code'] + ' - ' +$data['id_activite'] + ' - ' + $data['id_mission'] + ' - '+ $data['nom']+ ' - '+ $data['prenom']+ ' - '+ $data['identification']+ ' - '+ $data['date_naissance']+ ' - '+ $data['age']+ ' - '+ $data['sexe']+ ' - '+ $data['nationalite']+ ' - '+ $data['adresse']+ ' - '+ $data['commentaire']+ ' - '+ $data['intervention_victime']+ ' - '+ $data['centre_accueil']);
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.AJOUTE_VICTIME_BILAN_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau -1 !<br />Ajout impossible...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau 00 !<br />Ajout impossible...'); 
        }
        else if (buf==="1")
        {
            swal({   title: "Succès !",   text: "Les informations de la victime ont bien étées enregistrées dans le bilan.",   type: "success",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            $("#bouton_fermer_non_modal").click();
                //ouvrir_page_bilan_victime(null);
        });
            
            
            
            
        }else{
            ouvre_alerte('Erreur réseau 01 !<br />Ajout impossible...' + buf); 
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Ajout impossible...'); 
      
  })
  .always(function() {

  })
  ;        
}    
function update_victime(){
    
    var idactivite='';
    var idmission='';
    
    if (pass3=='activite'){
        idactivite=pass2;
        idmission='';
    }else if (pass3=='mission'){
        idactivite='';
        idmission=pass2;
    }else{
        return;
    }
    
    var nom_find=$("#input_nom_victime").val();
    var prenom_find=$("#input_prenom_victime").val();
    var identification_find=$("#input_identification_victime").val();
    var date_naissance_find=$("#input_date_naissance_victime").val();
    var age_find=$("#input_age_victime").val();
    var sexe_find=$( "#combobox_choix_sexe_victime").find(":selected").val();
    var nationalite_find=$("#input_nationalite_victime").val();
    var adresse_find=$("#input_adresse_victime").val();
     var commentaire_find=$("#input_commentaire_victime").val();
    
    var heure_pris_en_charge_find=$("#input_heure_pris_en_charge").val();
    var heure_entree_pc_find=$("#input_heure_entree").val();
    var heure_sortie_pc_find=$("#input_heure_sortie").val();
    
    var array_heure=new Array();
    array_heure.push({heure_pris_en_charge:heure_pris_en_charge_find});
    array_heure.push({heure_entree_pc:heure_entree_pc_find});
    array_heure.push({heure_sortie_pc:heure_sortie_pc_find});
    
    var Json_horaires=JSON.stringify(array_heure);
   
    var bilan_circonstanciel=$("#input_bilan_circonstanciel").val();
    var interventioin_victime_find=$("#input_intervention_victime").val();
    var centre_accueil_find=$("#input_centre_accueil").val();
    
    if (nom_find==''){
        swal({   title: "ATTENTION !",   text: "Vous devez renseigner le nom de la victime avat de sauvegarder.",   type: "warning",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok", closeOnConfirm: true }, function(){   
            
        });
        return;
    }
     
    var $data={
        code:Global.code_administrateur, 
        id_victime:donnees_victime.c6,
        nom:nom_find,
        prenom:prenom_find,
        identification:identification_find,
        date_naissance:date_naissance_find,
        age:age_find,
        sexe:sexe_find,
        nationalite:nationalite_find,
        adresse:adresse_find,
        commentaire:commentaire_find,
        json_horaires:Json_horaires,
        bilan_circonstanciel:bilan_circonstanciel,
        intervention_victime:interventioin_victime_find,
        centre_accueil:centre_accueil_find
    }

    //alert(Global.AJOUTE_VICTIME_BILAN_URI + ' - ' + $data['code'] + ' - ' +$data['id_activite'] + ' - ' + $data['id_mission'] + ' - '+ $data['nom']+ ' - '+ $data['prenom']+ ' - '+ $data['identification']+ ' - '+ $data['date_naissance']+ ' - '+ $data['age']+ ' - '+ $data['sexe']+ ' - '+ $data['nationalite']+ ' - '+ $data['adresse']+ ' - '+ $data['commentaire']+ ' - '+ $data['intervention_victime']+ ' - '+ $data['centre_accueil']);
    
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.UPDATE_VICTIME_BILAN_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau -1 !<br />Mise à jour impossible...'); 
				

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau 00 !<br />Mise à jour impossible...'); 
        }
        else if (buf==="1")
        {
            swal({   title: "Succès !",   text: "Les informations de la victime ont bien étées mises à jour dans le bilan.",   type: "success",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
                //alert(pass1 + ' - ' + pass2 + ' - ' + pass3);
                ouvrir_page_bilan_victime(pass1,pass2,pass3);
            //$("#bouton_fermer_non_modal").click();
        });
            
            
            
            
        }else{
            ouvre_alerte('Erreur réseau 01 !<br />Mise à jour impossible...' + buf); 
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Mise à jour impossible...'); 
      
  })
  .always(function() {

  })
  ;        
}   
function rempli_champ_victime(){
    
    $("#input_nom_victime").val(donnees_victime.nom);
    $("#input_prenom_victime").val(donnees_victime.prenom);
    $("#input_identification_victime").val(donnees_victime.identification);
    $("#input_date_naissance_victime").val(donnees_victime.date_naissance);
    $("#input_age_victime").val(donnees_victime.age);
    $("#combobox_choix_sexe_victime option:contains("+donnees_victime.sexe+")").attr('selected', true);
    $("#input_nationalite_victime").val(donnees_victime.nationalite);
    $("#input_adresse_victime").val(donnees_victime.adresse.replace(/<br.*?>/g, "\n"));
    
    if (donnees_victime.json_horaires!=''){
         var horaires_object = JSON.parse(donnees_victime.json_horaires);
         $("#input_heure_pris_en_charge").val(horaires_object[0].heure_pris_en_charge);
        $("#input_heure_entree").val(horaires_object[1].heure_entree_pc);
        $("#input_heure_sortie").val(horaires_object[2].heure_sortie_pc);
    }else{
         $('#input_heure_pris_en_charge').val('');
         $('#input_heure_entree').val('');
         $('#input_heure_sortie').val('');
    }
   
    
   
    
    $("#input_bilan_circonstanciel").val(donnees_victime.bilan_circonstanciel.replace(/<br.*?>/g, "\n"));
    $("#input_commentaire_victime").val(donnees_victime.commentaire.replace(/<br.*?>/g, "\n"));
    $("#input_intervention_victime").val(donnees_victime.type_intervention.replace(/<br.*?>/g, "\n"));
    $("#input_centre_accueil").val(donnees_victime.centre_accueil.replace(/<br.*?>/g, "\n"));
       
}   

function GetAge(birthDate) {
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}    
    
if (edition=='1'){
    rempli_champ_victime();
    $('#bouton_ajouter_victime').text(' Mettre à jour ')
}
    
});
    
</script>