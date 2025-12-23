var Global = {
    
        administrateur_sur_carte:true,
    
        nom_de_lapplication:"REZO+ InLine",
		version_du_soft:v_soft,
		
		SIZE_LIMITE_GALERIE:"100",
		APPLI_TYPE_PC:"3",
	
		code_administrateur:utilisateur_session['code_administrateur'],
		indicatif_administrateur:utilisateur_session['indicatif_administrateur'],
		genre_administrateur:"",
		nom_administrateur:utilisateur_session['nom_administrateur'],
		prenom_administrateur:utilisateur_session['prenom_administrateur'],
		telephone_administrateur:utilisateur_session['telephone_administrateur'],
		mail_administrateur:utilisateur_session['mail_administrateur'],
		date_fin_validite_licence:utilisateur_session['date_fin_validite_licence'],
		icone_administrateur:utilisateur_session['icone_administrateur'],
		
		date_creation_compte_administrateur:"",
		position_administrateur:"",
		etat_administrateur:1,
		administrateur_sur_carte:false,

		 APP_SERVER_URL:(function() {
				var hostname = window.location.hostname;
				var protocol = window.location.protocol;

				var localIndicators = ['localhost', '127.0.0.1', '::1', 'local', '.local', '.dev'];
				var isLocal = false;
				for (var i = 0; i < localIndicators.length; i++) {
					if (hostname.indexOf(localIndicators[i]) !== -1) {
						isLocal = true;
						break;
					}
				}
				if (!isLocal && /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/.test(hostname)) {
					isLocal = true;
				}

				if (isLocal) {
					// Use the same protocol as the current page to avoid mixed content issues
					return protocol + '//' + hostname + '/rezopcinline';
				} else {
					return 'https://www.web-dream.fr';
				}
			})(), 
		 REGISTER_URI:"/dev/rezo_flash_code/creat_customer.php", 
		 UPDATEUSER_URI:"/dev/rezo_flash_code/updateuser_customer.php",
		 UPDATE_URI:"/dev/rezo_flash_code/update_customer.php", 
		 FINDUSER_URI:"/dev/rezo_flash_code/find_customer.php",
		 DELETEUSER_URI:"/dev/rezo_flash_code/delete_customer.php",
		 INFOUSER_URI:"/dev/rezo_flash_code/info_customer.php",
		 LOCATIONUSER_URI:"/dev/rezo_flash_code/location_customer.php",
		 SAVEACTIVITE_URI:"/dev/rezo_flash_code/save_activite.php",
		 REFRESH_ACTIVITE_URI:"/dev/rezo_flash_code/refresh_activite.php",
		 DELETE_ACTIVITE_URI:"/dev/rezo_flash_code/delete_activite.php",
		 INFO_ACTIVITE_URI:"/dev/rezo_flash_code/info_activite.php",
		 UPDATE_ACTIVITE_URI:"/dev/rezo_flash_code/update_activite.php",
		 FIND_PARAMETRES_ADMINISTRATEUR_URI:"/dev/rezo_flash_code/find_parametres_administrateur.php",
		 UPDATE_PARAMETRES_ADMINISTRATEUR_URI:"/dev/rezo_flash_code/update_parametres_administrateur.php",
		 DELETE_HISTORIQUE_URI:"/dev/rezo_flash_code/delete_historique.php",
		 AJOUTE_DANS_HISTORIQUE_URI:"/dev/rezo_flash_code/ajout_dans_historique.php",
		 LIT_HISTORIQUE_URI:"/dev/rezo_flash_code/lit_historique.php",
		 ENVOI_MAIL_HISTORIQUE_URI:"/dev/rezo_flash_code/envoi_mail_historique.php",
		 UPDATE_INFO_ADMINISTRATEUR:"/dev/rezo_flash_code/updateuser_customer.php",
		 LIT_INFO_ADMINISTRATEUR_URI:"/dev/rezo_flash_code/lit_info_administrateur.php",
		 TEST_LICENCE_ADMINISTRATEUR_URI:"/dev/rezo_flash_code/test_licence_administrateur.php",
		 ENVOI_MAIL_SUCCES_CREATION_COMPTE_URI:"/dev/rezo_flash_code/envoi_mail_succes_creation_compte.php",
		 LIT_INFO_CODE_URI:"/dev/rezo_flash_code/lit_info_code.php",
		 SAVE_MISSION_URI:"/dev/rezo_flash_code/save_mission.php",
		 REFRESH_MISSION_URI:"/dev/rezo_flash_code/refresh_mission.php",
		 DELETE_MISSION_URI:"/dev/rezo_flash_code/delete_mission.php",
		 INFO_MISSION_URI:"/dev/rezo_flash_code/info_mission.php",
		 UPDATE_MISSION_URI:"/dev/rezo_flash_code/update_mission.php",
		 INFOUSER_MISSION_URI:"/dev/rezo_flash_code/info_customer_mission.php",
		 ACTIVE_MISSION_URI:"/dev/rezo_flash_code/active_mission.php",
		 CLOTURER_MISSION_URI:"/dev/rezo_flash_code/cloturer_mission.php",
		 DELETE_HISTORIQUE_MISSION_URI:"/dev/rezo_flash_code/delete_historique_mission.php",
		 AJOUTE_DANS_HISTORIQUE_MISSION_URI:"/dev/rezo_flash_code/ajout_dans_historique_mission.php",
		 LIT_HISTORIQUE_MISSION_URI:"/dev/rezo_flash_code/lit_historique_mission.php",
		 AJOUTE_CODE_PC_TABLE_CONTACT_URI:"/dev/rezo_flash_code/ajoute_code_pc_table_contact.php",
		 AJOUTE_CODE_UTILISATEUR_DANS_TABLE_CONTACT_URI:"/dev/rezo_code/ajout_code_au_pc.php",
		 RETOURNE_CONTACT_URI:"/dev/rezo_flash_code/retourne_contact.php",
		 EFFACE_CONTACT_URI:"/dev/rezo_flash_code/efface_contact.php",
		 UPDATE_INDICATIF_USER_URI:"/dev/rezo_flash_code/update_indicatif_user.php",
		 AJOUTE_VICTIME_BILAN_URI:"/dev/rezo_flash_code/ajoute_victime_bilan.php",
         REFRESH_LISTE_VICTIMES_URI:"/dev/rezo_flash_code/refresh_liste_victime.php",
         DELETE_VICTIME_URI:"/dev/rezo_flash_code/delete_victime.php",
         UPDATE_VICTIME_BILAN_URI:"/dev/rezo_flash_code/update_victime_bilan.php",
         GET_ACTIVITE_URI:"/dev/rezo_flash_code/get_activite.php",
         LIT_HISTORIQUE_WITH_ID_URI:"/dev/rezo_flash_code/lit_historique_with_id.php",
         GET_USER_FROM_IDS_URI:"/dev/rezo_flash_code/get_users_from_ids.php",
         MODIFIE_STATUT_USER_URI:"/dev/rezo_flash_code/modifie_statut_user.php",
    
         MODIFIE_ICONID_USER_URI:"/dev/rezo_flash_code/modifie_iconid_user.php",
    
         ENVOI_MESSAGE_USER_URI:"/dev/rezo_flash_code/envoi_message_user.php",
    
		 statut_color_0:"#ffffff",
		 statut_color_1:"#00ff00",
		 statut_color_2:"#ffc000",
		 statut_color_3:"#ff0000",
		 statut_color_4:"#ffff00",
		 statut_color_5:"#000000",
		 marker_default_height:30,
		 marker_default_width:30,
		markerFixeArray:[],
		marker_administrateur:"",
		
		lecture_parametre_carte_ok:false,

};

var heure_jour_mois=[{label:"1 heure" ,data:"1" },{label:"2 heures" ,data:"2" },{label:"3 heures" ,data:"3" },{label:"6 heures" ,data:"6" },{label:"12 heures" ,data:"12" },{label:"1 jour" ,data:"24" },{label:"2 jours" ,data:"48" },{label:"3 jours" ,data:"72" },{label:"1 semaine" ,data:"168" },{label:"1 mois" ,data:"210" }];

var language_datatable= {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }};
var AllMarkerOnMap=[];   
var count=0;

var taille_max_historique_deja_dit_activite=false;
var taille_max_historique_deja_dit_mission=false;
var taille_max_historique_deja_dit_activite_nom="";
var taille_max_historique_deja_dit_mission_nom="";

var markers_fixe_on_map = new Array();
var markers_map_label_fixe_on_map = new Array();
var marker_ma_position_on_map = new Array();
var markerArray=new Array();

var compteur_horloge_1000ms=0;

var page_en_cours="";
var activite_is_running;
var mission_is_running;
var Id_activite_en_cours;
var Id_mission_en_cours;
var activite_en_cours;
var mission_en_cours;
var usergroupList;
var memo_etat;
var	memo_statut;

var polyline_user_array=new Array();

var user_pastille_a_afficher=new Array();
var memo_poi_opener_infowindows=null;
var timer_refresh_utilisateur_activite= null;
var page_historique_type_encours="";

var timer_fermer_page_erreur_reseau;

var nb_slide_ouvert=0;

var mySound_alarme = new Audio(base_url+'sound/alarme1.mp3');
var mySound_message_recu = new Audio(base_url+'sound/message_recu.mp3');

var trace_polyline_user=false;

var kml_array = new Array();

var varblink;

var ligne_feux_user_array=new Array();


$(window).load(function() {
    
    
    
  if ((screen.width < 1024) && (screen.height < 768)) {
        //window.location = "http://www.web-dream.fr/rezopcinline_js/no_mobile.php";
      window.location = "no_mobile.php";
      return;
  }
    // Animate loader off screen
    $(".loader_site").fadeOut("slow");
    
});
$(window).on('resize', function() {
    rezise_850();
    
})
window.onload=function() {
    rezise_850();
    init_UI();
   
};
window.onbeforeunload = function (e) {
  var e = e || window.event;

  // For IE and Firefox
  if (e) {
    e.returnValue = 'Voulez-vous vraiment quitter cette page ?';
  }

  // For Safari
  return 'Voulez-vous vraiment quitter cette page ?';
};

$(document).ready( function() {
   
    
    $.ajaxSetup ({
    // Disable caching of AJAX responses
    cache: false
    });

    
    horloge_1000ms('div_horloge');
    
    
    /* methode pour fenetre non modal */
    
    $('#load_non_modal_a_propos').on("click", function() {
        affiche_page_a_propos();
        
    });
    
    
    $("#load_non_modal_page_activite").on("click", function() {
        ferme_page_reglages();
        if ( $("#content_non_modal").is(':visible') ){
            if (page_en_cours!=="activite"){
                $("#content_non_modal").slideUp('fast', function() {


                        $("#content_non_modal").html('');
                        $("#content_non_modal").load(base_url+"nonmodal/activite.php",{burl:base_url});
                        $("#content_non_modal").slideDown('fast');
                        $( "#content_non_modal" ).draggable();
                        page_en_cours="activite"; 
                        
                });
            }
            
        }else{
            $("#content_non_modal").load(base_url+"nonmodal/activite.php",{burl:base_url});
            $("#content_non_modal").slideDown('fast');
            $( "#content_non_modal" ).draggable();
            page_en_cours="activite";
        }
        
    });
    
    $("#load_non_modal_page_mission").on("click", function() {
        ferme_page_reglages();
        if ( $("#content_non_modal").is(':visible') ){
            if (page_en_cours!=="mission"){
                $("#content_non_modal").slideUp('fast', function() {
                    
                        $("#content_non_modal").html('');
                        $("#content_non_modal").load(base_url+"nonmodal/mission.php",{burl:base_url});
                        $("#content_non_modal").slideDown('fast');
                        $( "#content_non_modal" ).draggable();
                        page_en_cours="mission";
                   
                });
            }
        }else{
            $("#content_non_modal").load(base_url+"nonmodal/mission.php",{burl:base_url});
            $("#content_non_modal").slideDown('fast');
            $( "#content_non_modal" ).draggable();
            page_en_cours="mission";
        }
    });
    
    $("#load_non_modal_page_markers").on("click", function() {
        
        ferme_page_reglages();
        
        /*if (Cookies.get('showDialog_nouveau_marker_fixe') == undefined || Cookies.get('showDialog_nouveau_marker_fixe') == null || Cookies.get('showDialog_nouveau_marker_fixe') != 'false') {
            swal('Attention.','Depuis la version 4.2 de l\'application, le principe de positionnement des marqueurs fixes a changé. Veuillez lire les instructions pour prendre connaissance de la nouvelle procédure. Il est aussi possible maintenant de renomer un marqueur fixe en cliquant dessus.','warning');
            Cookies.set('showDialog_nouveau_marker_fixe', 'false', { expires: 365 });
        }*/
        
        
        if ( $("#content_non_modal").is(':visible') ){
            if (page_en_cours!=="choix_marker"){
                $("#content_non_modal").slideUp('fast', function() {
                    
                        $("#content_non_modal").html('');
                        $("#content_non_modal").load(base_url+"nonmodal/choix_marker.php",{burl:base_url});
                        $("#content_non_modal").slideDown('fast');
                        $( "#content_non_modal" ).draggable();
                        page_en_cours="choix_marker";
                    
                 });
                
            }
        }else{
            $("#content_non_modal").load(base_url+"nonmodal/choix_marker.php",{burl:base_url});
            $("#content_non_modal").slideDown('fast');
            $( "#content_non_modal" ).draggable();
            page_en_cours="choix_marker";
        }
    });

    $("#load_non_modal_page_efface_markers_fixe").on("click", function() {
        
        if (markers_fixe_on_map.length==0){
            swal('Suppression impossible.','Il n\'y a pas de marqueurs fixes sur la carte!','error');
        }else{
            
            swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer tous les marqueurs fixes ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
                    for (var i = 0; i < markers_fixe_on_map.length; i++) {
                        markers_fixe_on_map[i].setMap(null);
                    }
                    markers_fixe_on_map = new Array(); 
                    markers_map_label_fixe_on_map = new Array();
                });
            
            
            
            /*if (confirm('Êtes-vous sûr de vouloir effacer tous les marqueurs fixes ?')) {
            for (var i = 0; i < markers_fixe_on_map.length; i++) {
                    markers_fixe_on_map[i].setMap(null);
                }
                markers_fixe_on_map = new Array();
            } else {
           
            }*/
        }
    });
    
    $('#load_non_modal_page_centrage_carte').on("click", function() {
        
        zoomtofit(true);
    });
    
    $('#load_non_modal_page_recherche_adresse').on("click", function() {
        
        $('#div_pour_recherche').slideDown('fast');
    });
    
    $('#bouton_fermer_page_recherche').on("click", function() {
        
        $('#div_pour_recherche').slideUp('fast');
    });
    
    $("#load_non_modal_page_parametres").on("click", function() {
        if ( $("#content_non_modal").is(':visible') ){
            
                $("#content_non_modal").slideUp('fast', function() {
                         $("#content_non_modal").html('');
                 });
        }
        
        $("#div_pour_page_parametres").slideDown('fast');
        page_en_cours="parametres";
        }
    );

    $("#load_non_modal_page_saisie_victime").on("click", function() {
        
        var pass1="";
        var pass2="";
        var pass3="";
        if (activite_is_running){
			pass1=activite_en_cours;
            pass2=Id_activite_en_cours;
            pass3="activite";
    		//affiche_page_historique(activite_en_cours,null,"activite");
		}else if (mission_is_running){
			pass1=mission_en_cours;
            pass2=Id_mission_en_cours;
            pass3="mission";
    		//affiche_page_historique(mission_en_cours,Id_mission_en_cours,"mission");
		}
        
        ferme_page_reglages();
        if ( $("#content_non_modal").is(':visible') ){
            if (page_en_cours!=="saise_victime"){
                $("#content_non_modal").slideUp('fast', function() {


                        $("#content_non_modal").html('');
                        $("#content_non_modal").load(base_url+"nonmodal/declarer_victime.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3,edition:'0',donnees_victime:null});
                        $("#content_non_modal").slideDown('fast');
                        $( "#content_non_modal" ).draggable();
                        page_en_cours="saise_victime"; 
                        
                });
            }
            
        }else{
            $("#content_non_modal").load(base_url+"nonmodal/declarer_victime.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3,edition:'0',donnees_victime:null});
            $("#content_non_modal").slideDown('fast');
            $( "#content_non_modal" ).draggable();
            page_en_cours="saise_victime";
        }
    });
    $("#bouton_voir_bilan").on("click", function() {
        ouvrir_page_bilan_victime(null,null,null);
        
    });
    $("#bouton_voir_main_courante").on("click", function() {
        ouvrir_page_main_courante(null,null,null);
        
    });
    
    
    $(document).on('click', '#bouton_fermer_non_modal', function() {

        $("#content_non_modal").slideUp('fast', function() {
                $("#content_non_modal").html('');
                page_en_cours="";
            });
    });
    
    $(document).on('click', '#bouton_fermer_page_historique', function() {

        $("#div_pour_page_historique").slideUp('fast', function() {
            });
    });
   
    
    
    
    
    $(document).on('click', '#bouton_fermer_page_modifier_activite_non_modal', function() {

        $("#content_non_modal").slideUp('fast', function() {
                $("#content_non_modal").html('');
                $("#content_non_modal").load(base_url+"nonmodal/activite.php",{burl:base_url});
                $("#content_non_modal").slideDown('fast');
                $( "#content_non_modal" ).draggable();
                page_en_cours="activite";
            });
    });
    
    $(document).on('click', '#bouton_fermer_page_modifier_mission_non_modal', function() {

        $("#content_non_modal").slideUp('fast', function() {
                $("#content_non_modal").html('');
                $("#content_non_modal").load(base_url+"nonmodal/mission.php",{burl:base_url});
                $("#content_non_modal").slideDown('fast');
                $( "#content_non_modal" ).draggable();
                page_en_cours="mission";
            });
    });

    $(document).on('mouseover', '.class_marker_a_deplacer', function() {
        $(this).css('cursor','pointer');
    });
        
    
    deplacemarker2();
    
    creer_page_a_propos();
    creer_page_historique();
    creer_page_parametres();
    
    
    
});


function rezise_850(){
    if($(window).height() > 850) {
        $('#menu_nom_activite').removeClass('menu_nom_activite_inf_850');
        $('#header_logo img').removeClass('header_logo_inf_850_img');
        $('#menu a').removeClass('menu_a_inf_850');
        $('#menu img').removeClass('menu_img_inf_850');
    }else{
        $('#menu_nom_activite').addClass('menu_nom_activite_inf_850');
        $('#header_logo img').addClass('header_logo_inf_850_img');
        $('#menu a').addClass('menu_a_inf_850');
        $('#menu img').addClass('menu_img_inf_850');
        $('#my_menu').addClass('my_menu_inf_850');
    }
}


function horloge_1000ms(el) {
  if(typeof el=="string") { el = document.getElementById(el); }
  function actualiser_time() {
        
        var resultat;
      
        date = new Date;
        annee = date.getFullYear();
        moi = date.getMonth();
        mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
        j = date.getDate();
        jour = date.getDay();
        jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        resultat = jours[jour]+' '+j+' '+mois[moi]+' '+annee+' - '+h+':'+m+':'+s;
        el.innerHTML = resultat;
      
      compteur_horloge_1000ms++;
      
      if (compteur_horloge_1000ms==2){
          test_position_admin_2000();
      }
      
      if (compteur_horloge_1000ms==5){
          compteur_horloge_1000ms=0;
          test_ping_5000ms('id_connexion_internet');
      }
    
  }
  actualiser_time();
  setInterval(actualiser_time,1000);
}
function test_ping_5000ms(el) {
  if(typeof el=="string") { el = document.getElementById(el); }
  
    function actualiser_ping() {
        
          if (jqxhr) {
            jqxhr.abort();
        }

        var startDate = new Date();
        var resultat;
        var color;
        
        var jqxhr = $.post(base_url+"js/test_ping.html")
        
        .done(function(data, textStatus, jqXHR ) {
            var endDate   = new Date();
            var temps_aller_retour = (endDate.getTime() - startDate.getTime()) ;
            

            if (temps_aller_retour>1500){
                resultat="Mauvaise connexion Internet"
                color  = "#ab2b2b";
            }else if (temps_aller_retour>500){
                resultat="Connexion Internet Moyenne"
                color  = "#FFC000";
            }else{
                resultat="Connexion Internet Correcte"
                color  = "#53ab5b";
            }
            
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        
        resultat="Pas de connexion Internet"
        color  = "#FFFFFF";
      })
      .always(function() {
        el.innerHTML = resultat ;
        el.style.backgroundColor=color;

      })
      ;
    
  }
    
  actualiser_ping();
}
function test_position_admin_2000(){
    
    envoi_position_administrateur();
    
    
}
function init_UI(){
    document.getElementById("nom_utilisateur").innerHTML = "Utilisateur : " + Global.nom_administrateur + " " + Global.prenom_administrateur;
    
    $('#div_pour_deplacement_marker').hide();
    
    document.getElementById('id_connexion_internet').innerHTML = "Evaluation de la connexion..." ;
    document.getElementById('id_connexion_internet').style.backgroundColor='#aaa';
    document.getElementById('my_position_emise').style.backgroundColor="#ab2b2b";
    document.getElementById('my_position_emise').innerHTML="Votre position n'est pas diffusée";
    
    $( "#content_non_modal" ).draggable({handle:"#curseur_pour_deplacer_page", drag:function(){
        
        var offset=$("#content_non_modal").offset();
        
        var xPos = offset.left;
        var yPos = offset.top;
        if (xPos<(-$('#content_non_modal').width()+50)){
            $("#content_non_modal").offset({left:-$('#content_non_modal').width()+50+2,top:offset.top+2})
            return false;
        }
        if (yPos<0){
            $("#content_non_modal").offset({left:offset.left,top:2});
            return false;
        }
    }});
    
    $('#div_pour_page_historique').draggable({handle:"#curseur_pour_deplacer_page", drag:function(){
        
        var offset=$("#div_pour_page_historique").offset();
        
        var xPos = offset.left;
        var yPos = offset.top;
        if (xPos<(-$('#div_pour_page_historique').width()+50)){
            $("#div_pour_page_historique").offset({left:-$('#div_pour_page_historique').width()+50+2,top:offset.top+2})
            return false;
        }
        if (yPos<0){
            $("#div_pour_page_historique").offset({left:offset.left,top:2});
            return false;
        }
    }});
    //$('#my_menu').resizable();
    
    $('#bouton_menu_stop_activite').hide();
    $('#bouton_menu_historique').hide();
    $('#load_non_modal_page_saisie_victime').hide();
    $('#bouton_voir_bilan').hide();
    $('#bouton_voir_main_courante').hide();
    
    $('#bouton_menu_historique').click(function(){
        if (activite_is_running){
			lit_historique(activite_en_cours);
    		affiche_page_historique(activite_en_cours,null,"activite");
		}else if (mission_is_running){
			lit_historique_mission(Id_mission_en_cours);
    		affiche_page_historique(mission_en_cours,Id_mission_en_cours,"mission");
		}
    });
    $('#bouton_menu_stop_activite').click(function(){
       $('#bouton_fermer_page_historique').click();
	   page_historique_type_encours="";
        if (activite_is_running){
            stop_activite();
        } else if (mission_is_running){
            stop_mission();
        }
    });
    /*$('#bouton_declarer_victime').click(function(){
        if (activite_is_running){
    		affiche_page_saisie_victime(activite_en_cours,Id_activite_en_cours,"activite");
		}else if (mission_is_running){
    		affiche_page_saisie_victime(mission_en_cours,Id_mission_en_cours,"mission");
		}
    });*/
    
    
    
    $('#menu_nom_activite').html("<p>Pas d'activité ou de mission en cours de géolocalisation.</p>");
    $('#menu_nom_activite').css({'background-color':'rgba(155, 155, 155, 1)','border': '2px solid #979499'});
     
    $('#bouton_fermer_page_erreur').click(function(){
        
        $('#div_pour_page_erreur_reseau').slideUp('fast');
    });
    
    $('#page_slide_alert_photo').hide();
}


function ouvrir_page_bilan_victime(p1,p2,p3){
        
    var pass1="";
    var pass2="";
    var pass3="";
    
    if (p1!=null){
        pass1=p1;
        pass2=p2;
        pass3=p3;
        
    }else{
        if (activite_is_running){
			pass1=activite_en_cours;
            pass2=Id_activite_en_cours;
            pass3="activite";
		}else if (mission_is_running){
			pass1=mission_en_cours;
            pass2=Id_mission_en_cours;
            pass3="mission";
		}else{
            return;
        }
    }
    
        
        
        ferme_page_reglages();
        if ( $("#content_non_modal").is(':visible') ){
            if (page_en_cours!=="voir_bilan"){
                $("#content_non_modal").slideUp('fast', function() {


                        $("#content_non_modal").html('');
                        $("#content_non_modal").load(base_url+"nonmodal/voir_bilan.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3});
                        $("#content_non_modal").slideDown('fast');
                        $( "#content_non_modal" ).draggable();
                        page_en_cours="voir_bilan"; 
                        
                });
            }
            
        }else{
            $("#content_non_modal").load(base_url+"nonmodal/voir_bilan.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3});
            $("#content_non_modal").slideDown('fast');
            $( "#content_non_modal" ).draggable();
            page_en_cours="voir_bilan";
        }
    }

function ouvrir_page_main_courante(p1,p2,p3){
        
    var pass1="";
    var pass2="";
    var pass3="";
    
    if (p1!=null){
        pass1=p1;
        pass2=p2;
        pass3=p3;
        
    }else{
        if (activite_is_running){
			pass1=activite_en_cours;
            pass2=Id_activite_en_cours;
            pass3="activite";
		}else if (mission_is_running){
			pass1=mission_en_cours;
            pass2=Id_mission_en_cours;
            pass3="mission";
		}else{
            return;
        }
    }
    
        
        
        ferme_page_reglages();
        if ( $("#content_non_modal").is(':visible') ){
            if (page_en_cours!=="voir_main_courante"){
                $("#content_non_modal").slideUp('fast', function() {


                        $("#content_non_modal").html('');
                        $("#content_non_modal").load(base_url+"nonmodal/main_courante.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3});
                        $("#content_non_modal").slideDown('fast');
                        $( "#content_non_modal" ).draggable();
                        page_en_cours="voir_main_courante"; 
                        
                });
            }
            
        }else{
            $("#content_non_modal").load(base_url+"nonmodal/main_courante.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3});
            $("#content_non_modal").slideDown('fast');
            $( "#content_non_modal" ).draggable();
            page_en_cours="voir_main_courante";
        }
    }

var positionnement_marker_fixe_en_cours=false;
//var id_marqueur_fixe="";

function deplacemarker2(){
    
    $(document).on('click', '.class_marker_a_deplacer', function(e) {
        
        $(document).off('click', '.class_marker_a_deplacer');
        
        //e.stopPropagation();
        //e.preventDefault();
        
        positionnement_marker_fixe_en_cours=true;
        
        var id_marqueur_fixe=$(this).attr('id');
        
        if (id_marqueur_fixe==='id_marker_ma_position' && Global.administrateur_sur_carte==true)
        {
            swal("Erreur","Vous ne pouvez pas déplacer ce marqueur. L'icône 'Ma postion' est déjà sur la carte.",'error');
            deplacemarker2();
            return true;
        }    

        $('#content_non_modal').fadeOut(200);
        
        var clone_marker=$(this).clone();
        clone_marker.appendTo('#div_pour_deplacement_marker');
        $('#div_pour_deplacement_marker').show();
        $('#div_pour_deplacement_marker').css({'top': e.pageY-clone_marker.height()-5}); 
        $('#div_pour_deplacement_marker').css({'left': e.pageX-clone_marker.width()/2});

        map.addListener('click', function(e) {
          
            
            google.maps.event.clearListeners(map, 'rightclick');
            map.addListener('rightclick', function(e) {
                affiche_lien_google_map(e);
            });
            google.maps.event.clearListeners(map, 'click');
            $('body').unbind('mousemove');
            
            //var id_marqueur_fixe=$(this).attr('id');

            var get_imgage = $('.class_marker_a_deplacer').find('img');
            var src = get_imgage.attr('src');

            //alert(id_marqueur_fixe);
            placeMarker_fixe(e.latLng, map, src, id_marqueur_fixe);

            $('#content_non_modal').fadeIn(200);
            
            
           $('#div_pour_deplacement_marker').hide();
           $('#div_pour_deplacement_marker').html('');
            
            positionnement_marker_fixe_en_cours=false;
            
            deplacemarker2();
     
        });
        
        google.maps.event.clearListeners(map, 'rightclick');
        
        map.addListener('rightclick', function(e) {
            //e.stopPropagation();
            //e.preventDefault();
            google.maps.event.clearListeners(map, 'rightclick');
            annule_positionneent_marker_fixe(e);
        });
        $('body').mousemove(function(e){
          
            //var y = e.pageY;
            //var x = e.pageX;                    
            $('#div_pour_deplacement_marker').css({'top': e.pageY-clone_marker.height()-5}); 
            $('#div_pour_deplacement_marker').css({'left': e.pageX-clone_marker.width()/2});
            //a_bouger=true;
            
            if (e.pageX<$('#map_canvas').offset().left || e.pageX>$('#map_canvas').offset().left+$('#map_canvas').width()
                   || e.pageY<$('#map_canvas').offset().top || e.pageY>$('#map_canvas').offset().top+$('#map_canvas').height())
                {
                    annule_positionneent_marker_fixe(e);
                        
                }
        });

        return true;
        
    });
    
    
}
function annule_positionneent_marker_fixe(e){
    
    $('body').unbind('mousemove');
    google.maps.event.clearListeners(map, 'click');
    google.maps.event.clearListeners(map, 'rightclick');
   
    
    
    $('#div_pour_deplacement_marker').hide();
    $('#div_pour_deplacement_marker').html('');

    positionnement_marker_fixe_en_cours=false;
    

    $('#content_non_modal').fadeIn(200);
    
    deplacemarker2();
     //e.stopPropagation();
    //e.preventDefault();
    map.addListener('rightclick', function(e) {
                affiche_lien_google_map(e);
            });
}

function envoi_message(code){
    
    
    Swal.fire({
  title: 'Saisir le message à envoyer',
    showCancelButton:true,
  input: 'textarea',
  
  inputValidator: (value) => {
    if (!value) {
      return 'Vous devez écrire un message !'
    }//else{
       //return Swal.fire({html: 'You selected: ' + value});
    //}
  },
  showLoaderOnConfirm: true,
  preConfirm: (value) => {
      
    var message_out=Global.indicatif_administrateur+'{+rezo+}'+value.toString();
      
     var $datasend={
            code:code,
            type_action:'reception_message',
            valeur:message_out,
        }
    
    var jqxhr_modifie_statut = $.post(Global.APP_SERVER_URL+Global.ENVOI_MESSAGE_USER_URI,$datasend)

    .done(function(data, textStatus, jqXHR ) {

        if (data==="-1")
        {
            swal("Erreur.","Impossible d'envoyer le message ! code erreur : 1","error");  
            return;

        }else if (data==="")
        {
			swal("Erreur.","Impossible d'envoyer le message ! code erreur : 2","error");  
            return;
        }
        else if (data==="1")
        {
            swal({title:"Succès.",text:"Le message viens d'être envoyée.\nLe terminal mobile du moyen vas bientôt le recevoir (1 minute maximum).",type:"success",timer:5000});
            hideAllInfoWindows(map,code);
            var messtemp=value.toString();
            var message_formate=messtemp.replace(/\n/g, " ");
            ajoute_dans_historique($('#div_horloge').html()+",Envoi d'un message à "+code+" : "+message_formate);
            return;
        }else{
            swal("Erreur.","Impossible d'envoyer le message ! code erreur : 3. data : "+data,"error");  
            return;
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      swal("Erreur.","Impossible d'envoyer le message ! code erreur : 4","error");  
     
  })
  .always(function() {

  })
  ;
  }
});
}
function change_statut(code){
    
    
    Swal.fire({
  title: 'Sélectionnez le nouveau statut :',
    showCancelButton:true,
  input: 'radio',
  inputOptions: {
      '1': "Opérationnel",
      '2': "Départ",
      '3': "Intervention en cours",
      '4': "Retour",
      '5': "Urgence"
  },
  inputValidator: (value) => {
    if (!value) {
      return 'Vous devez choisir un statut !'
    }//else{
       //return Swal.fire({html: 'You selected: ' + value});
    //}
  },
  showLoaderOnConfirm: true,
  preConfirm: (value) => {
      
     var $datasend={
            code:code,
            type_action:'modification_statut',
            valeur:value.toString(),
        }
    
    var jqxhr_modifie_statut = $.post(Global.APP_SERVER_URL+Global.MODIFIE_STATUT_USER_URI,$datasend)

    .done(function(data, textStatus, jqXHR ) {

        if (data==="-1")
        {
            swal("Erreur.","Impossible de modifier le statut !","error");  
            return;

        }else if (data==="")
        {
			swal("Erreur.","Impossible de modifier le statut !","error");  
            return;
        }
        else if (data==="1")
        {
            swal({title:"Succès.",text:"La modification du statut viens d'être envoyée.\nLe changement aura lieu lorsque que le terminal mobile du moyen aura reçu la demande (1 minute maximum).",type:"success",timer:5000});
            hideAllInfoWindows(map,code);
            return;
        }else{
            swal("Erreur.","Impossible de modifier le statut !","error");  
            return;
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      swal("Erreur.","Impossible de modifier le statut !","error");  
     
  })
  .always(function() {

  })
  ;
  }
});
}
function change_iconid(code){
Swal.fire({
  title: 'Choix de la nouvelle icône',
        showCancelButton:true,
        cancelButtonText: "Annuler",
        confirmButtonText:"Valider",
  html:
    '<p>Veuillez choisir la nouvelle icône</p>'+
        
    '<table width="100%" border="1" align="center" cellpadding=5>'+
                  '<tr align="center">'+
        
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_1.png" /></br><input type="radio" id="marker_user_1" name="marker_swal" value="1" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_2.png" /></br><input type="radio" id="marker_user_2" name="marker_swal" value="2" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_3.png" /></br><input type="radio" id="marker_user_3" name="marker_swal" value="3" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_4.png" /></br><input type="radio" id="marker_user_4" name="marker_swal" value="4" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_5.png" /></br><input type="radio" id="marker_user_5" name="marker_swal" value="5" /></td>'+
        
                    
                  '</tr>'+
        '<tr align="center">'+
        
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_6.png" /></br><input type="radio" id="marker_user_6" name="marker_swal" value="6" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_7.png" /></br><input type="radio" id="marker_user_7" name="marker_swal" value="7" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_8.png" /></br><input type="radio" id="marker_user_8" name="marker_swal" value="8" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_9.png" /></br><input type="radio" id="marker_user_9" name="marker_swal" value="9" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_10.png" /></br><input type="radio" id="marker_user_10" name="marker_swal" value="10" /></td>'+
        
                    
                  '</tr>'+
        '<tr align="center">'+
                    
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_11.png" /></br><input type="radio" id="marker_user_11" name="marker_swal" value="11" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_12.png" /></br><input type="radio" id="marker_user_12" name="marker_swal" value="12" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_13.png" /></br><input type="radio" id="marker_user_13" name="marker_swal" value="13" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_14.png" /></br><input type="radio" id="marker_user_14" name="marker_swal" value="14" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_15.png" /></br><input type="radio" id="marker_user_15" name="marker_swal" value="15" /></td>'+
        
                    
                  '</tr>'+
        '<tr align="center">'+
                    
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_16.png" /></br><input type="radio" id="marker_user_16" name="marker_swal" value="16" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_17.png" /></br><input type="radio" id="marker_user_17" name="marker_swal" value="17" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_18.png" /></br><input type="radio" id="marker_user_18" name="marker_swal" value="18" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_19.png" /></br><input type="radio" id="marker_user_19" name="marker_swal" value="19" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_20.png" /></br><input type="radio" id="marker_user_20" name="marker_swal" value="20" /></td>'+
        
                    
                  '</tr>'+
        '<tr align="center">'+
                    
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_21.png" /></br><input type="radio" id="marker_user_21" name="marker_swal" value="21" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_22.png" /></br><input type="radio" id="marker_user_22" name="marker_swal" value="22" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_23.png" /></br><input type="radio" id="marker_user_23" name="marker_swal" value="23" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_24.png" /></br><input type="radio" id="marker_user_24" name="marker_swal" value="24" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_25.png" /></br><input type="radio" id="marker_user_25" name="marker_swal" value="25" /></td>'+
        
                    
                  '</tr>'+
        
        '<tr align="center">'+
                    
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_26.png" /></br><input type="radio" id="marker_user_26" name="marker_swal" value="26" /></td>'+
        '<td><img src="https://www.web-dream.fr/rezopcinline/images/marker_user_27.png" /></br><input type="radio" id="marker_user_27" name="marker_swal" value="27" /></td>'+
        
                    
                  '</tr>'+
        
                '</table>',
  focusConfirm: false,
  showLoaderOnConfirm: true,
  preConfirm: () => {
    
        var radios = document.getElementsByName('marker_swal');
        var valeur=0;
        for(var i = 0; i < radios.length; i++){
         if(radios[i].checked){
         valeur = radios[i].value;
         }
        }
      if (valeur==0){
          swal('Erreur','Veuillez choisir une nouvelle icône.','error');
      }else{
            
            var $datasend={
                code:code,
                type_action:'modification_iconid',
                valeur:valeur.toString(),
            }   
    
    var jqxhr_modifie_iconid = $.post(Global.APP_SERVER_URL+Global.MODIFIE_ICONID_USER_URI,$datasend)

    .done(function(data, textStatus, jqXHR ) {

        if (data==="-1")
        {
            swal("Erreur.","Impossible de modifier l\icône !","error");  
            return;

        }else if (data==="")
        {
			swal("Erreur.","Impossible de modifier l\icône !","error");  
            return;
        }
        else if (data==="1")
        {
            swal({title:"Succès.",text:"La modification de l\icône viens d'être envoyée.\nLe changement aura lieu lorsque que le terminal mobile du moyen aura reçu la demande (1 minute maximum).",type:"success",timer:5000});
            hideAllInfoWindows(map,code);
            return;
        }else{
            swal("Erreur.","Impossible de modifier l\icône !","error");  
            return;
        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      swal("Erreur.","Impossible de modifier l\icône !","error");  
     
  })
  .always(function() {

  })
  ;
      }
  }
});
}
function modifier_indicatif_utilisateur(code){
    
    swal({   title: "Modification de l'indicatif",   text: "Entrez le nouvel indicatif.",   type: "input",   showCancelButton: true,   closeOnConfirm: false,   animation: "slide-from-top",   inputPlaceholder: "Nouvel indicatif" }, function(inputValue){   if (inputValue === false) return false;      if (inputValue === "") {     swal.showInputError("Vous devez saisir un nouvel indicatif!");     return false   }      
    
    var $data={
            code_utilisateur_a_modifier:code, 
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
            swal({title:"Succès.",text:"La modification de l\indicatif viens d'être envoyée.\nLe changement aura lieu lorsque que le terminal mobile du moyen aura reçu la demande (1 minute maximum).",type:"success",timer:5000});
            hideAllInfoWindows(map,code);
        }
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Modification impossible...'); 
      
  })
  .always(function() {

  });    
    
 });
    
    
}
function saisir_ligne_feux_utilisateur(code,latlng_lat,latlng_lng){
    swal({   
        title: "Visuel feux",
        text: "Entrez l'angle du visuel feux en degrés (0-360). Une fois la droite tracée, vous pouvez la supprimer en cliquant dessus.",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Angle en degrés (0-360)" },

        function(inputValue){
            var float= /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;

            if (inputValue === false) return false;
            if (inputValue === "" || !float.test(inputValue) || parseFloat(inputValue)<0 || parseFloat(inputValue)>360) {
                swal.showInputError("Vous devez saisir un angle en degrés compris entre 0 et 360°!");
                return false
           }      
           var latlng = new google.maps.LatLng(parseFloat(latlng_lat),parseFloat(latlng_lng));
           
            var trouver_poly_ligne_feux=false;
            var poly_ligne_feux_temp_trouver;
            for (j=0;j<ligne_feux_user_array.length;j++){
                    if (ligne_feux_user_array[j].poly_id===code){
                    trouver_poly_ligne_feux=true;
                    poly_ligne_feux_temp_trouver=ligne_feux_user_array[j];
                    break;
                }
            }
            if (trouver_poly_ligne_feux){
                efface_ligne_feux_un_user(poly_ligne_feux_temp_trouver)
            }




           create_ligne_feux_user(code,latlng,inputValue)
           swal.close();
           hideAllInfoWindows(map,'null')
        }
    );
}

function create_contenu_infowindow(code,indicatif,latlng,etat,iconId,nom,prenom,tel,precision,distance){
    var etat_texte="";
    switch (etat)
        {
           case 0:
            etat_texte="Actif";
            break;

           case 1:
            etat_texte="Opérationnel";
            break;
                
           case 2: 
            etat_texte="Départ";
            break;
           case 3: 
            etat_texte="Intervention en cours";
            break;
            case 4:
            etat_texte="Retour";
            break;
           case 5: 
            etat_texte="Urgence";
            break;

           default: 
               etat_texte="Actif";
        }
    
    var Contenu_info='<div style="text-align:center;">Indicatif : '+indicatif+'<br />Nom : '+nom+'<br />Prénom : '+prenom+'<br />Tel : '+tel+'<br />Lat : '+latlng.lat()+'<br />Long : '+latlng.lng()+'<br />Précision : '+precision+' m'+'<br />Distance : '+distance+' Km'+'<br /><br /><center><strong>Statut : ' + etat_texte 
    + '</strong><button type="button" class="bouton_infowindow" style="margin-top:10px;" onclick="envoi_message(\''+code+'\')">Envoyer un message</button><div style="display:flex"><button type="button" class="bouton_infowindow" style="margin:5px;" onclick="change_statut(\''+code+'\')">Modifier le statut</button><button type="button" class="bouton_infowindow" style="margin:5px;" onclick="change_iconid(\''+code+'\')">Modifier l\'icône</button><button type="button" class="bouton_infowindow" style="margin:5px;" onclick="modifier_indicatif_utilisateur(\''+code+'\')">Modifier l\'indicatif</button></div><button type="button" class="bouton_infowindow" onclick="saisir_ligne_feux_utilisateur(\''+code+'\',\''+latlng.lat()+'\',\''+latlng.lng()+'\')">Visuel feux</button></center></div>';
    //var Contenu_info='Indicatif : '+indicatif+'<br />Nom : '+nom+'<br />Prénom : '+prenom+'<br />Tel : '+tel+'<br />Lat : '+latlng.lat()+'<br />Long : '+latlng.lng()+'<br />Précision : '+precision+' m'+'<br />Distance : '+distance+' Km'+'<br /><br /><center><strong>Statut : ' + etat_texte + '</strong><button type="button" class="bouton_infowindow" onclick="envoi_message(\''+code+'\')">Envoyer un message</button><button type="button" class="bouton_infowindow" onclick="change_statut(\''+code+'\')">Modifier le statut</button><button type="button" class="bouton_infowindow" onclick="change_iconid(\''+code+'\')">Modifier l\'icône</button><button type="button" class="bouton_infowindow" onclick="modifier_indicatif_utilisateur(\''+code+'\')">Modifier l\'indicatif</button></center>';
    
    return Contenu_info;
}

function create_marker(code,indicatif,latlng,etat,iconId,nom,prenom,tel,precision) {
    
    var couleur_fond_label=gere_couleur_etat(etat);
    
    var mapLabel = new MapLabel({
            code:code,
            pastille_array:user_pastille_a_afficher,
            back_color:couleur_fond_label,
            text: indicatif,
            position: latlng,
            map: map,
            fontSize: 12,
            align: 'center'
            });
    
    var marker = new google.maps.Marker({
            position: latlng,
            icon: base_url+"images/marker_user_"+iconId+".png",
            map: map,
            marker_id: code,
            mapLabel:mapLabel,
            info_w:null
          });
        marker.bindTo('map', mapLabel);
        marker.bindTo('position', mapLabel);
        marker.setDraggable(false);
    
    
    
    var distance="---";
    if (Global.administrateur_sur_carte){
        
        var distance_float=google.maps.geometry.spherical.computeDistanceBetween (Global.position_administrateur, latlng);
        var distance=(distance_float/1000).toFixed(2);
    }
    
    var Contenu_info=create_contenu_infowindow(code,indicatif,latlng,etat,iconId,nom,prenom,tel,precision,distance);
    
    var infowindow = new google.maps.InfoWindow({
        content: Contenu_info
    });
    marker.info_w = infowindow;
    google.maps.event.addListener(marker, 'click', function(event) {
        infowindow.open(map, marker);
        memo_poi_opener_infowindows=indicatif;
        
        affiche_polyline_un_user(code);
    });
    google.maps.event.addListener(infowindow,'closeclick',function(){
        memo_poi_opener_infowindows="";
        
        if (!trace_polyline_user){
            efface_polyline_un_user_with_code(code);
        }
    });
    
    return marker;
}
/******************* ligne feux */
function create_ligne_feux_user(code,latlng,angle){

    var ligne_feux = new google.maps.Polyline({
        strokeColor: '#000',
        strokeOpacity: 0.8,
        strokeWeight: 4,
        poly_id:code,
    });
    google.maps.event.addListener(ligne_feux, 'click', function() {
        efface_ligne_feux_un_user(ligne_feux);
    });
  
    ligne_feux.setMap(map);
  
    var path = ligne_feux.getPath();
    path.push(latlng);

    var latlng_final = new google.maps.geometry.spherical.computeOffset(latlng, 1000*1000, angle);

    path.push(latlng_final);
    ligne_feux_user_array.push(ligne_feux);
    //console.log(ligne_feux_user_array)
}
function update_ligne_feux_user(ligne_feux,latlng){
    //alert (poly);
    if (ligne_feux){
        var path = ligne_feux.getPath();
        var coord=path.getAt(0);

        if(!coord.equals(latlng)){
            path.insertAt(0,latlng);
            path.removeAt(1);
        }
        
        ligne_feux.setMap(map);
        
    }
}
function efface_ligne_feux_un_user(poly){
    if (poly){
        poly.setMap(null);
        const index = ligne_feux_user_array.indexOf(poly);
        const x = ligne_feux_user_array.splice(index, 1);
        //console.log(ligne_feux_user_array)
    }
}
/******************* fin ligne feux */

function create_polyline_user(code,latlng){
    
  var rand_color = randomColor({
   luminosity: 'dark',
   hue: 'random'
});
    
  var poly = new google.maps.Polyline({
    strokeColor: rand_color,
    strokeOpacity: 0.8,
    strokeWeight: 4,
    poly_id:code,
    affiche:1,
    memo_affiche:0  
  });
    google.maps.event.addListener(poly, 'click', function() {
        efface_polyline_un_user(poly);
    });
  if (trace_polyline_user){
    poly.setMap(map);
  }
  var path = poly.getPath();
  path.push(latlng);
    
  polyline_user_array.push(poly);
  
}
function update_polyline_user(poly,latlng){
    //alert (poly);
    if (poly){
        var path = poly.getPath();

        var las_coord=path.getAt(path.getLength()-1);

        if(!las_coord.equals(latlng)){
            path.push(latlng);
            if (path.getLength()>1000){
                path.removeAt(0); 
                //alert('surchage');
            }
        }
        if (trace_polyline_user && poly.affiche==1){
            poly.setMap(map);
        }
    }
}
function effface_polyline_user(){
    for (var i = 0; i < polyline_user_array.length; i++) {
                    polyline_user_array[i].setMap(null);
                    polyline_user_array[i].affiche=0;
                    polyline_user_array[i].memo_affiche=0;
                }
}
function affiche_polyline_user(){
    for (var i = 0; i < polyline_user_array.length; i++) {
                    polyline_user_array[i].setMap(map);
                    polyline_user_array[i].affiche=1;
                }
}
function affiche_polyline_un_user(code){
    var trouver_poly=false;
    var poly_temp_trouver;
    for (j=0;j<polyline_user_array.length;j++){
         if (polyline_user_array[j].poly_id===code){
            trouver_poly=true;
            poly_temp_trouver=polyline_user_array[j];
            break;
        }
    }
    if (trouver_poly){
        
        if (poly_temp_trouver.affiche==1 && trace_polyline_user){
            poly_temp_trouver.memo_affiche=1;
        }else{
            poly_temp_trouver.memo_affiche=0;
        }
        poly_temp_trouver.affiche=1;   
        poly_temp_trouver.setMap(map);
    }else{
         
    }
}
function efface_polyline_un_user_with_code(code){
    var trouver_poly=false;
    var poly_temp_trouver;
    for (j=0;j<polyline_user_array.length;j++){
         if (polyline_user_array[j].poly_id===code){
            trouver_poly=true;
            poly_temp_trouver=polyline_user_array[j];
            break;
        }
    }
    if (trouver_poly){
        if (poly_temp_trouver.memo_affiche==0){
            poly_temp_trouver.affiche=0;   
            poly_temp_trouver.setMap(null);
        }
        
    }else{
         
    }
}

function efface_polyline_un_user(poly){
    if (poly){
        poly.affiche=0;   
        poly.memo_affiche=0;   
        poly.setMap(null);
    }
}

function update_marker(marker_pass,code,indicatif,latlng,etat,iconId,nom,prenom,tel,precision) {
 
    var couleur_fond_label=gere_couleur_etat(etat);
    marker_pass.mapLabel.set('pastille_array',user_pastille_a_afficher);
    marker_pass.mapLabel.set('back_color',couleur_fond_label);
    marker_pass.mapLabel.set('text',indicatif);
    marker_pass.mapLabel.set('pastille_array',user_pastille_a_afficher);
    //marker_pass.mapLabel.set('position',latlng);
    
    marker_pass.setPosition(latlng);
    marker_pass.setIcon(base_url+"images/marker_user_"+iconId+".png");
    
    
    var distance="---";
    if (Global.administrateur_sur_carte){
        
        var distance_float=google.maps.geometry.spherical.computeDistanceBetween (Global.position_administrateur, latlng);
        var distance=(distance_float/1000).toFixed(2);
    }
    
    var Contenu_info=create_contenu_infowindow(code,indicatif,latlng,etat,iconId,nom,prenom,tel,precision,distance);
    
    marker_pass.info_w.setContent(Contenu_info);
    
    
}
function ouvre_loader_general(texte){
    $('#text_div_pour_loader').html('<p>'+texte+'</p>');
    $('#div_pour_loader').slideDown('fast');
}
function ferme_loader_general(){
    $('#div_pour_loader').slideUp('fast');
}
function ouvre_alerte(texte){
    $('#texte_page_erreur').html('<p>'+texte+'</p>');
    clearTimeout(timer_fermer_page_erreur_reseau);
    
    $('#div_pour_page_erreur_reseau').slideDown('fast', function() {
        timer_fermer_page_erreur_reseau=setInterval(function(){$('#div_pour_page_erreur_reseau').slideUp('slow');},4000);
    });
    
    
}
function ouvre_alerte_reception_document(){
    $('#logo_document_recu').attr("src",base_url+"images/button_documents.png");
    $('#titre_alerte_reception_documents').html('<h2>Titre</h2>');
    $('#message_alerte_reception_documents').html('<p>message</p>');
    var temp_pos=$('.div_header').height()+100;
    $('#page_slide_alert_photo').css('top',temp_pos+'px');
    $('#page_slide_alert_photo').show('fast', function() {
        setTimeout(function(){$('#page_slide_alert_photo').hide('slow');},4000);
    });
}

function envoi_position_administrateur(){
	
    
    
        if (Global.administrateur_sur_carte){
            
            update_position_administrateur();
            
            
            
            affiche_texte_geolocalisation_admin(true);
            //$('#bouton_modifier_mon_statut').show();
            
            
        }else{
            
            
            affiche_texte_geolocalisation_admin(false);
            //$('#bouton_modifier_mon_statut').hide();
            
        }
	
    }    
function affiche_texte_geolocalisation_admin(is_geolocalising){
    
        if (is_geolocalising){
            $('#my_position_emise').css({'backgroundColor':'#53ab5b'});
            $('#my_position_emise').html("Votre position est diffusée");
        }else{
            $('#my_position_emise').css({'backgroundColor':'#ab2b2b'});
            $('#my_position_emise').html("Votre position n'est pas diffusée");
        }
    }    
function update_position_administrateur(){
        
        var $data={
            mon_code:Global.code_administrateur,
            latitude:Global.position_administrateur.lat,
            longitude:Global.position_administrateur.lng,
            altitude:0,
            precision:5,
            etat:Global.etat_administrateur
        }
        
        var jqxhr = $.post(Global.APP_SERVER_URL+Global.UPDATE_URI,$data)
        
        .done(function(data, textStatus, jqXHR ) {
            
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
            my_position_emise.innerHTML="Erreur réseau !";
      })
      .always(function() {
 
      })
      ;
        
        
    }

var marker_fixe_is_draged=false;

function placeMarker_fixe(latLng, map, src,id_marqueur_fixe) {
  var mapLabel = new MapLabel({
                  text: 'Marqueur fixe',
                  position: latLng,
                  map: map,
                  fontSize: 12,
                  align: 'center'
                });
    if (id_marqueur_fixe==='id_marker_ma_position'){
        
        
        mapLabel.set('text','Ma position');
        Global.administrateur_sur_carte=true;
        Global.position_administrateur=latLng;
    }
    //var marker = new google.maps.Marker();
      var marker = new google.maps.Marker({
            position: latLng,
            icon: src,
            map: map
          });
        marker.bindTo('map', mapLabel);
        marker.bindTo('position', mapLabel);
        marker.setDraggable(true);
        if (id_marqueur_fixe==='id_marker_ma_position'){
            marker_ma_position_on_map.push(marker);
            marker.addListener('dragend', function(e) {
                Global.position_administrateur=e.latLng;
            });
        }else{
            markers_fixe_on_map.push(marker);
            markers_map_label_fixe_on_map.push(mapLabel);
            
        }
        google.maps.event.addListener(marker, 'dragstart', function() {
            marker_fixe_is_draged=true;
        });
        google.maps.event.addListener(marker, 'drag', function(e) {
            marker_fixe_is_draged=true;
            affiche_position_marker_fix_in_drag(e.latLng);
        });
        google.maps.event.addListener(marker, 'dragend', function() {
            marker_fixe_is_draged=false;
        });
        google.maps.event.addListener(marker, 'click', function(event) {
                
            for (var i = 0; i < marker_ma_position_on_map.length; i++) {
                    if (marker_ma_position_on_map[i] === this) {
                        this.setMap(null);
                        google.maps.event.clearListeners(this, 'dragend');
                        marker_ma_position_on_map.splice(i, 1);
                        Global.administrateur_sur_carte=false;
                        
                    }
                }
                for (var i = 0; i < markers_fixe_on_map.length; i++) {
                    if (markers_fixe_on_map[i] === this) {
                        
                        var index_maplabel=i;
                        var doit_etre_efface=this;
                        
                        Swal.fire({
                          title: 'Que voulez-vous faire ?',
                          text: "Voulez-vous renomer le marqueur fixe ou l\'effacer ?",
                          type: 'question',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Changer le nom du marqueur',
                          cancelButtonText: 'Effacer',
                          showCloseButton: true
                        }).then((result) => {

                          if (result.value) {
                            swal({
                              title: "Changement de nom",
                              text: "Entrez le nouveau nom du marqueur:",
                              type: "input",
                              showCancelButton: true,
                              cancelButtonText: 'Annuler', 
                              closeOnConfirm: true,
                              animation: "slide-from-top",
                              inputPlaceholder: "Nouveau nom"
                            },
                            function(inputValue){
                              if (inputValue === false) return false;

                              if (inputValue === "") {
                                swal.showInputError("Vous devez écrire quelque chose!");
                                return false;
                              }

                              var maplabel=markers_map_label_fixe_on_map[index_maplabel];
                              maplabel.set('text',inputValue);
                            return true;
                            });
                          }else if (
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                          ) {
                              doit_etre_efface.setMap(null);
                              markers_fixe_on_map.splice(index_maplabel, 1);
                              markers_map_label_fixe_on_map.splice(index_maplabel, 1);
                          }
                        });
                        
                        
                        
                        
                    }
                }

            });
  
}
function ouvre_page_modifier_activiter(data_pass){
    
    $("#content_non_modal").slideUp('fast', function() {
                $("#content_non_modal").html('');
                $("#content_non_modal").load(base_url+"nonmodal/modifier_activite.php",{burl:base_url,data_pass:data_pass});
                $("#content_non_modal").slideDown('fast');
                $( "#content_non_modal" ).draggable();
                page_en_cours="modifier_activite";
            });
        
    }
function ouvre_page_modifier_mission(data_pass){
    
    $("#content_non_modal").slideUp('fast', function() {
                $("#content_non_modal").html('');
                $("#content_non_modal").load(base_url+"nonmodal/modifier_mission.php",{burl:base_url,data_pass:data_pass});
                $("#content_non_modal").slideDown('fast');
                $( "#content_non_modal" ).draggable();
                page_en_cours="modifier_mission";
            });
        
    }
function ouvre_page_modifier_victime(data_pass,p1,p2,p3){
    
    var pass1=p1;
    var pass2=p2;
    var pass3=p3;
    /*
    if (activite_is_running){
        pass1=activite_en_cours;
        pass2=Id_activite_en_cours;
        pass3="activite";
        //affiche_page_historique(activite_en_cours,null,"activite");
    }else if (mission_is_running){
        pass1=mission_en_cours;
        pass2=Id_mission_en_cours;
        pass3="mission";
        //affiche_page_historique(mission_en_cours,Id_mission_en_cours,"mission");
    }else{
        if (p3=="activite"){
            pass1=data_pass.activite;
            pass2=data_pass.c6;
            pass3=p3;
        }else if (p3=="mission"){
            pass1=data_pass.mission;
            pass2=data_pass.c6;
            pass3=p3;
        }else{
            
        }
    }*/
    //alert(pass1 + '-' + pass2 + '-' + pass3);
    
    $("#content_non_modal").slideUp('fast', function() {
                $("#content_non_modal").html('');
                $("#content_non_modal").load(base_url+"nonmodal/declarer_victime.php",{burl:base_url,pass1:pass1,pass2:pass2,pass3:pass3,edition:'1',donnees_victime:data_pass});
                $("#content_non_modal").slideDown('fast');
                $( "#content_non_modal" ).draggable();
                page_en_cours="modifier_activite";
            });
        
    }
function creer_page_historique(){
    $("#div_pour_page_historique").html('');
    $('#div_pour_page_historique').load(base_url+"nonmodal/historique.php",{burl:base_url});
    $("#div_pour_page_historique" ).draggable();
}
function creer_page_a_propos(){
    $("#div_pour_page_a_propos").html('');
    $('#div_pour_page_a_propos').load(base_url+"nonmodal/a_propos.php",{burl:base_url,version_soft:Global.version_du_soft});
}
function creer_page_parametres(){
    $("#div_pour_page_parametres").html('');
    $('#div_pour_page_parametres').load(base_url+"nonmodal/parametres.php",{burl:base_url});
    $("#div_pour_page_parametres" ).draggable();
}

function affiche_page_historique(titre,Id_pass,type_encours_pass){

    $('#container_mail_hisrotique').slideUp('fast');

    if (activite_is_running || mission_is_running){
	  $("#div_bouton_ajouter_evenement_historique").show();
		
    }else{
        $("#div_bouton_ajouter_evenement_historique").hide();
    }
    
    $("#bouton_ajouter_evenement_historique").off('click');
    $("#bouton_ajouter_evenement_historique").click(function() {
        
        swal({
              title: "Ajouter un événement",
              text: "Entrez l'événement à ajouter (opération irréversible) :",
              type: "input",
              showCancelButton: true,
              cancelButtonText: 'Annuler', 
              closeOnConfirm: true,
              animation: "slide-from-top",
              inputPlaceholder: "Événement"
            },
            function(inputValue){
              if (inputValue === false) return false;

              if (inputValue === "") {
                return false;
              }

              ajoute_dans_historique($('#div_horloge').html()+","+inputValue);
            
            return true;
            });
     });
    
    
    $("#bouton_effacer_historique").off('click');
    $("#bouton_effacer_historique").click(function() {
        
        
        
        swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer l\'historique ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
            if (type_encours_pass==="mission")
            {
                efface_historique_mission(Id_pass);
            }else{
                efface_historique($('#titre_page_historique').html(),type_encours_pass,Id_pass);
            }
        });
        
    });
    
    $("#bouton_sauver_historique").off('click');
    $("#bouton_sauver_historique").click(function() {
        
        var text_final="";
        table_historique.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
            var data = this.data();
            text_final+=data.c1 + "," + data.c2 + "\r\n";
        } );
        
        var blob = new Blob([text_final], {type: "text/plain;charset=utf-8"});
        saveAs(blob, "Historique_" + $('#titre_page_historique').html() + ".csv");
    });
    
    $('#titre_page_historique').html(titre);
    
    $("#div_pour_page_historique").slideDown('fast');
}
function affiche_page_a_propos(){
    $("#div_pour_page_a_propos").slideDown('fast');
}
function lit_historique(activite_a_lire){
    
    //alert(activite_a_lire);
    //$('#textfield_historique').html('');
    table_historique.clear();
    table_historique.draw();
    
    var $data={
            mon_code:Global.code_administrateur,
            activite:activite_a_lire
        }
    
    var jqxhr_lit_historique = $.post(Global.APP_SERVER_URL+Global.LIT_HISTORIQUE_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Impossible de lire l\'historique.');    

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Impossible de lire l\'historique.');   
        }
        else
        {
                

                buf=buf.replace(/\\'/g, "'");
				buf=buf.replace(/\\\\n/g, "retourchariorezoozer");
				var trame=buf.split("\\n");
					
				var donnee_pour_datagrid=new Array();

            
            
                if (taille_max_historique_deja_dit_activite_nom===activite_a_lire){
                    if (!taille_max_historique_deja_dit_activite && trame.length>800){
                        swal("Attention !","L'historique de cette activité atteint le maximum de sa capacité. Vous devez effacer l'historique de cette activité. Le système peut être largement ralenti et subir des blocages.","error");
                        taille_max_historique_deja_dit_activite=true;
                    }

                }else{
                    taille_max_historique_deja_dit_activite_nom=activite_a_lire;
                    taille_max_historique_deja_dit_activite=false;
                    if (!taille_max_historique_deja_dit_activite && trame.length>800){
                        swal("Attention !","L'historique de cette activité atteint le maximum de sa capacité. Vous devez effacer l'historique de cette activité. Le système peut être largement ralenti et subir des blocages.","error");
                        taille_max_historique_deja_dit_activite=true;
                    }
                }
            
                for (i=1;i<trame.length;i++){
						trame[i]=trame[i].replace(/,/, "separatorrezorozero");
						var trame2=trame[i].split("separatorrezorozero");
						trame2[1]=trame2[1].replace(/retourchariorezoozer/g, "\r" );
						donnee_pour_datagrid.push({c_id:i, c1:trame2[0], c2:trame2[1]});
						//page_historique.datagridhistorique.addItem({c1:trame2[0], c2:trame2[1]});
						//texte_sortie=texte_sortie+trame2[0]+":<br />"+trame2[1]+"<br />-----------------------<br />";
						//page_historique.textfield_historique.text=page_historique.textfield_historique.text+trame2[0]+":\n"+trame2[1]+"\n-----------------------\n";
						
					}
            
                //$('#textfield_historique').html(texte_sortie);
					
                
                table_historique.rows.add(donnee_pour_datagrid);
                table_historique.draw();

        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible de lire l\'historique.');  
     
  })
  .always(function() {

  })
  ;
	
}
function lit_historique_mission(Id_mission){
    
    
    //$('#textfield_historique').html('');
    table_historique.clear();
    table_historique.draw();
    
    var $data={
            mon_code:Global.code_administrateur,
            Id_mission:Id_mission
        }
    
    var jqxhr_lit_historique = $.post(Global.APP_SERVER_URL+Global.LIT_HISTORIQUE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Impossible de lire l\'historique.');  

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Impossible de lire l\'historique.'); 
        }
        else
        {
                

                buf=buf.replace(/\\'/g, "'");
				buf=buf.replace(/\\\\n/g, "retourchariorezoozer");
				var trame=buf.split("\\n");
					
				//var texte_sortie="";
				var donnee_pour_datagrid=new Array();

                if (taille_max_historique_deja_dit_mission_nom===Id_mission){
                    if (!taille_max_historique_deja_dit_mission && trame.length>800){
                        swal("Attention !","L'historique de cette mission atteint le maximum de sa capacité. Vous devez effacer l'historique de cette mission. Le système peut être largement ralenti et subir des blocages.","error");
                        taille_max_historique_deja_dit_mission=true;
                    }

                }else{
                    taille_max_historique_deja_dit_mission_nom=Id_mission;
                    taille_max_historique_deja_dit_mission=false;
                    if (!taille_max_historique_deja_dit_mission && trame.length>800){
                        swal("Attention !","L'historique de cette mission atteint le maximum de sa capacité. Vous devez effacer l'historique de cette mission. Le système peut être largement ralenti et subir des blocages.","error");
                        taille_max_historique_deja_dit_mission=true;
                    }
                }
            
                for (i=1;i<trame.length;i++){
						trame[i]=trame[i].replace(/,/, "separatorrezorozero");
						var trame2=trame[i].split("separatorrezorozero");
						trame2[1]=trame2[1].replace(/retourchariorezoozer/g, "\r" );
						donnee_pour_datagrid.push({c_id:i, c1:trame2[0], c2:trame2[1]});
						//page_historique.datagridhistorique.addItem({c1:trame2[0], c2:trame2[1]});
						//texte_sortie=texte_sortie+trame2[0]+":<br />"+trame2[1]+"<br />-----------------------<br />";
						//page_historique.textfield_historique.text=page_historique.textfield_historique.text+trame2[0]+":\n"+trame2[1]+"\n-----------------------\n";
						
					}
            
                //$('#textfield_historique').html(texte_sortie);
					
                
                table_historique.rows.add(donnee_pour_datagrid);
                table_historique.draw();

        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible de lire l\'historique.');  
     
  })
  .always(function() {

  })
  ;
	
}
function efface_historique(activite_a_effacer,type_encours_pass,Id_pass){
    
if (activite_is_running || type_encours_pass==="activite"){
	var $data={
            mon_code:Global.code_administrateur,
            activite:activite_a_effacer
        }
    
    var jqxhr_lit_historique = $.post(Global.APP_SERVER_URL+Global.DELETE_HISTORIQUE_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Impossible de supprimer l\'historique.');  

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Impossible de supprimer l\'historique.');  
        }
        else if (buf==="1")
        {
                
                //$('#textfield_historique').html('');
                table_historique.clear();
                table_historique.draw();
                swal("Succès.","Effacement de l'historique réussi!","success");

        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible de supprimer l\'historique.');  
     
  })
  .always(function() {

  })
  ;
		
}else if (mission_is_running){
    
		efface_historique_mission(Id_pass);
}
}
function efface_historique_mission(Id_pass){
    
	var $data={
            mon_code:Global.code_administrateur,
            Id_mission:Id_pass
        }
    
    var jqxhr_efface_historique_mission = $.post(Global.APP_SERVER_URL+Global.DELETE_HISTORIQUE_MISSION_URI,$data)

    .done(function(data, textStatus, jqXHR ) {

        var buf=data.replace('return_txt=','');

        if (buf==="-1")
        {
            ouvre_alerte('Erreur réseau !<br />Impossible de supprimer l\'historique.');  

        }else if (buf==="")
        {
				ouvre_alerte('Erreur réseau !<br />Impossible de supprimer l\'historique.');  
        }
        else if (buf==="1")
        {
                
                //$('#textfield_historique').html('');
                table_historique.clear();
                table_historique.draw();
                swal("Succès.","Effacement de l'historique réussi!","success");

        }
		        
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      ouvre_alerte('Erreur réseau !<br />Impossible de supprimer l\'historique.');  
     
  })
  .always(function() {

  })
  ;
		

}
function lance_activite(data_pass){
	console.log('lance_activite appelée avec:', data_pass);
	
	if (!data_pass) {
		console.error('Erreur: data_pass est null ou undefined');
		return;
	}
	
	usergroupList=new Array();
	var temp1=data_pass.c7;
    var temp2=temp1.split(",");
	var temp_liste_code=temp2.join("{}");
	
	$('#bouton_fermer_page_historique').click();
	page_historique_type_encours="";
	//Global.first_stage.carte.menu_marker.visible=false;
	console.log('Appel de start_activite avec:', data_pass.c6, data_pass.activite, temp_liste_code, data_pass.liens_kml, data_pass.marqueurs_fixes);
	start_activite(data_pass.c6,data_pass.activite,temp_liste_code,data_pass.liens_kml,data_pass.marqueurs_fixes);
}
function lance_mission(data_pass){
	console.log('lance_mission appelée avec:', data_pass);
	
	if (!data_pass) {
		console.error('Erreur: data_pass est null ou undefined');
		return;
	}
	
	usergroupList=new Array();
	
	//var info_cache=membres[i]+"<-+->"+titre[i]+"<-+->"+adresse_mission[i]+"<-+->"+lien_googlemap_mission[i]+"<-+->"+message_mission[i]+"<-+->"+etat_mission[i]+"<-+->"+date_lancement[i]+"<-+->"+date_cloture[i]+"<-+->"+membres_lu_mission;
				
	var temp0=data_pass.c7;
	console.log('lance_mission - temp0 (c7):', temp0);
	
	if (!temp0) {
		console.error('Erreur: data_pass.c7 est null ou undefined');
		return;
	}
	
	var temp1=temp0.split("<-+->");
	console.log('lance_mission - temp1 après split(<-+->):', temp1);
	
	if (!temp1 || temp1.length === 0 || !temp1[0]) {
		console.error('Erreur: temp1[0] est null ou undefined');
		return;
	}
	
	var temp2=temp1[0].split(",");
	console.log('lance_mission - temp2 après split(,):', temp2);
	
	//var temp1:String=data_table_list_des_missions.getItemAt(Index).c7;
	//var temp2:Array=temp1.split(",");
	var temp_liste_code=temp2.join("{}");
	console.log('lance_mission - temp_liste_code final:', temp_liste_code);
	
	//this.out(); //modif v1.2
	//this.visible=false; //modif v1.2
	$('#bouton_fermer_page_historique').click();
	page_historique_type_encours="";
	
	console.log('Appel de start_mission avec:', data_pass.c6, data_pass.mission, temp_liste_code);
	start_mission(data_pass.c6,data_pass.mission,temp_liste_code);
}    
function start_activite(Id_activite,nom_de_activite,code_a_traiter,liens_kml,marqueurs_fixes){
	console.log('start_activite appelée avec:', Id_activite, nom_de_activite, code_a_traiter, liens_kml, marqueurs_fixes);
	
		stop_activite();
		stop_mission();
		Id_activite_en_cours=Id_activite;
		console.log('Appel de test_licence_administrateur pour activite');
		test_licence_administrateur("activite",nom_de_activite,code_a_traiter,liens_kml,marqueurs_fixes);
	
}
function start_mission(Id_mission,nom_de_mission,code_a_traiter){
	console.log('start_mission appelée avec:', Id_mission, nom_de_mission, code_a_traiter);
	//if (!activite_is_running && !mission_is_running){
		stop_activite();
		stop_mission();
		
		Id_mission_en_cours=Id_mission;
		console.log('Appel de test_licence_administrateur pour mission');
		test_licence_administrateur("mission",nom_de_mission,code_a_traiter,'','');
	//}
}
function start_activite2(nom_de_activite,code_a_traiter,liens_kml,marqueurs_fixes){
	
    	activite_en_cours=nom_de_activite;
		activite_is_running=true;
		ajoute_dans_historique($('#div_horloge').html()+","+"Lancement de l'activité "+nom_de_activite);
        
		$('#menu_nom_activite').html('<p>Activité : ' + nom_de_activite+'</p>');
        $('#menu_nom_activite').css({'background-color':'rgba(37, 159, 28, 0.75)','border': '2px solid #42993d'});
        start_blink();
		$('#menu_info_text').html('');
		$('#bouton_menu_historique').show();
        $('#bouton_menu_stop_activite').show();
		$('#bouton_menu_stop_activite').html('Stop Activité');
	
        $('#load_non_modal_page_saisie_victime').show();
        $('#bouton_voir_bilan').show();
        $('#bouton_voir_main_courante').show();
    
		usergroupList=new Array();
		remove_user_marker();
		
		memo_etat=new Array();
		memo_statut=new Array();
        polyline_user_array=new Array();
    
        ajout_trace_kml_enregistres(liens_kml);
    
		recherche_membre_activite(code_a_traiter);
		
}

function start_blink(){
    varblink=setInterval(function(){blink()}, 1600);
}
function stop_blink(){
    clearInterval(varblink);
}
function blink(){
    
    $("#menu_nom_activite").fadeTo(800, 0.8).fadeTo(800, 1.0);
}
function remove_user_marker(){
	for (var i = 0; i < markerArray.length; i++) {
                    markerArray[i].setMap(null);
                }
    for (var i = 0; i < polyline_user_array.length; i++) {
                    polyline_user_array[i].setMap(null);
                }
    for (var i = 0; i < ligne_feux_user_array.length; i++) {
        ligne_feux_user_array[i].setMap(null);
    }
	markerArray=new Array();
    polyline_user_array=new Array();
    ligne_feux_user_array=new Array();
}
function stop_activite(){
	if (activite_is_running){
		
        hideAllInfoWindows(map,"null");
        
		ajoute_dans_historique($('#div_horloge').html()+","+"Arrêt de l'activité "+activite_en_cours);
		activite_en_cours="";
        Id_activite_en_cours="";
		activite_is_running=false;
		$('#menu_nom_activite').html("<p>Pas d'activité ou de mission en cours de géolocalisation.</p>");
        $('#menu_nom_activite').css({'background-color':'rgba(155, 155, 155, 1)','border': '2px solid #979499'});
        stop_blink();
		$('#menu_info_text').html('');
		$('#bouton_menu_historique').hide();
        $('#bouton_menu_stop_activite').hide();
        $('#load_non_modal_page_saisie_victime').hide();
        $('#bouton_voir_bilan').hide();
        $('#bouton_voir_main_courante').hide();
		if (timer_refresh_utilisateur_activite!=null) clearTimeout(timer_refresh_utilisateur_activite);
		remove_user_marker();
        remove_trace_kml();
		affiche_texte_geolocalisation_admin(false);
		
	}
}
function start_mission2(nom_de_mission,code_a_traiter){
	
		mission_en_cours=nom_de_mission;
		mission_is_running=true;
		ajoute_dans_historique($('#div_horloge').html()+","+"Géolocalisation de la mission "+nom_de_mission);
	    $('#menu_nom_activite').html('<p>Mission : ' + nom_de_mission+'</p>');	
        $('#menu_nom_activite').css({'background-color':'rgba(37, 159, 28, 0.75)','border': '2px solid #42993d'});
        start_blink();
		$('#menu_info_text').html('');
		$('#bouton_menu_historique').show();
        $('#bouton_menu_stop_activite').show();
        $('#load_non_modal_page_saisie_victime').show();
        $('#bouton_voir_bilan').show();
		$('#bouton_menu_stop_activite').html('Stop Mission');
		usergroupList=new Array();
		remove_user_marker();
		
		memo_etat=new Array();
		memo_statut=new Array();
        polyline_user_array=new Array();
    
		console.log('start_mission2 - Appel de recherche_membre_activite avec code_a_traiter:', code_a_traiter);
		console.log('start_mission2 - Type de code_a_traiter:', typeof code_a_traiter);
		console.log('start_mission2 - Longueur de code_a_traiter:', code_a_traiter ? code_a_traiter.length : 'null/undefined');
		recherche_membre_activite(code_a_traiter);
}
function stop_mission(){
	if (mission_is_running){
		
        hideAllInfoWindows(map,"null");
        
		ajoute_dans_historique($('#div_horloge').html()+","+"Arrêt de géolocalisation de la mission "+mission_en_cours);
		Id_mission_en_cours="";
		mission_en_cours="";
		mission_is_running=false;
		$('#menu_nom_activite').html("<p>Pas d'activité ou de mission en cours de géolocalisation.</p>");
        $('#menu_nom_activite').css({'background-color':'rgba(155, 155, 155, 1)','border': '2px solid #979499'});
        stop_blink();
		$('#menu_info_text').html('');
		$('#bouton_menu_historique').hide();
        $('#bouton_menu_stop_activite').hide();
        $('#load_non_modal_page_saisie_victime').hide();
        $('#bouton_voir_bilan').hide();
		if (timer_refresh_utilisateur_activite!=null) clearTimeout(timer_refresh_utilisateur_activite);
        
		remove_user_marker();
		affiche_texte_geolocalisation_admin(false);
		
		
	}
}
function ajoute_dans_historique(texte_a_ajouter){
    //console.log(texte_a_ajouter);
	if (activite_is_running){
	  
		
        var temp_activite=activite_en_cours;
		var $data={
            mon_code:Global.code_administrateur,
            activite:activite_en_cours,
            textaajouter:texte_a_ajouter
        }
    
        var jqxhractivite = $.post(Global.APP_SERVER_URL+Global.AJOUTE_DANS_HISTORIQUE_URI,$data)

        .done(function(data, textStatus, jqXHR ) {

            var buf=data.replace('return_txt=','');

            if (buf==="-1")
            {
                ouvre_alerte('Erreur réseau!<br />Ajout impossible...'); 


            }else if (buf==="")
            {
                ouvre_alerte('Erreur réseau !<br />Ajout impossible...'); 
            }
            else
            {
                lit_historique(temp_activite);
            }
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
              ouvre_alerte('Erreur réseau !<br />Problème technique...'); 

          })
          .always(function() {

          })
          ;

	}else{
		
		if (mission_is_running){
			ajoute_dans_historique_mission(Id_mission_en_cours,texte_a_ajouter);
		}else{
			ouvre_alerte("Ajout Impossible.<br />Aucune activité ou mission en cours, Ajout dans l'historique impossible!");
		}
	}
}
function ajoute_dans_historique_mission(Id_mission,texte_a_ajouter){
	
    var $data={
            mon_code:Global.code_administrateur,
            Id_mission:Id_mission,
            textaajouter:texte_a_ajouter
        }
    
        var jqxhr = $.post(Global.APP_SERVER_URL+Global.AJOUTE_DANS_HISTORIQUE_MISSION_URI,$data)

        .done(function(data, textStatus, jqXHR ) {

            var buf=data.replace('return_txt=','');

            if (buf==="-1")
            {
                ouvre_alerte('Erreur réseau!<br />Ajout impossible...'); 


            }else if (buf==="")
            {
                    ouvre_alerte('Erreur réseau !<br />Ajout impossible...'); 
            }
            else
            {

                    
				    lit_historique_mission(Id_mission);

                }
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
              ouvre_alerte('Erreur réseau !<br />Problème technique...'); 

          })
          .always(function() {

          })
          ;
}
function test_licence_administrateur(activite_mission,nom_de_activite_mission,code_a_traiter,liens_kml,marqueurs_fixes){
    console.log('test_licence_administrateur appelée avec:', activite_mission, nom_de_activite_mission, code_a_traiter);
    console.log('Global.code_administrateur:', Global.code_administrateur);
    console.log('URL:', Global.APP_SERVER_URL+Global.TEST_LICENCE_ADMINISTRATEUR_URI);
    
    var $data={
            mon_code:Global.code_administrateur
        }
    
    console.log('Données envoyées:', $data);
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.TEST_LICENCE_ADMINISTRATEUR_URI,$data)

    .done(function(data, textStatus, jqXHR ) {
        console.log('Réponse de test_licence_administrateur:', data);

        var buf=data.replace('return_txt=','');
        console.log('buf après nettoyage:', buf);

        if (buf.indexOf("ok")==0)
			{
				buf=buf.slice(2,buf.length)
				
			
				Global.code_administrateur=buf.slice(0,8);
				Global.date_fin_validite_licence=buf.slice(8,buf.length);
				console.log('Licence OK, lancement de', activite_mission);

				
				
				if (activite_mission==="activite"){
					console.log('Appel de start_activite2');
					start_activite2(nom_de_activite_mission,code_a_traiter,liens_kml,marqueurs_fixes);
				}else if (activite_mission==="mission"){
					console.log('Appel de start_mission2');
					start_mission2(nom_de_activite_mission,code_a_traiter);
				}
				
				
			}else if (buf===""){
				ouvre_alerte("Erreur réseau !<br />Lecture des informations impossible...");
			}else if (buf==="-1")
			{
				swal("Erreur de licence !","Impossible de lancer l'activité. La clé de licence est abscente ou invalide! Veuillez acquérir une clé de licence sur le site www.web-dream.fr","error");
			}else if (buf==="-2")
			{
				swal("Erreur de licence !","Clé de licence expirée! Veuillez renouveller votre clé de licence sur le site www.web-dream.fr","error");
			
			}
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      console.error('Erreur dans test_licence_administrateur:', textStatus, errorThrown);
      console.error('Response:', jqXHR.responseText);
      console.error('Status:', jqXHR.status);
      ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
      
  })
  .always(function() {

  })
  ;
    
	
}
function Newusergroup(Title_pass , subtitle_pass , badgebitmap_pass){
    this.Title = Title_pass;
    this.subtitle = subtitle_pass;
    this.badgeBitmap=badgebitmap_pass;
}
function recherche_membre_activite(liste_des_codes){
    console.log('recherche_membre_activite appelée avec liste_des_codes:', liste_des_codes);
    console.log('Global.code_administrateur:', Global.code_administrateur);
    console.log('Global.indicatif_administrateur:', Global.indicatif_administrateur);

    var $data={
        liste_des_codes:liste_des_codes,
        code_PC:Global.code_administrateur+"--rezo-wd-ozer--"+Global.indicatif_administrateur,
	    plateforme:"REZO PC Inline"
        }
    
    // Le fichier info_activite.php local fait automatiquement un proxy vers la production
    // donc on utilise toujours l'URL locale
    console.log('Données envoyées à info_activite.php:', $data);
    console.log('URL complète:', Global.APP_SERVER_URL+Global.INFO_ACTIVITE_URI);
    var jqxhr = $.post(Global.APP_SERVER_URL+Global.INFO_ACTIVITE_URI, $data)

    .done(function(data, textStatus, jqXHR ) {
            console.log('Réponse de info_activite.php:', data);
            console.log('Status:', textStatus);
            console.log('HTTP Status:', jqXHR.status);

            var buf=data.replace('return_txt=','');
            console.log('buf après nettoyage:', buf);
            console.log('Longueur de buf:', buf.length);

            if (buf==="-1")
			{
				console.error('Erreur: Le serveur a retourné -1 (aucun membre trouvé)');
				ouvre_alerte("Erreur réseau !<br />Actualisation impossible...");
				
			} else if (buf==="")
			{
				console.error('Erreur: Réponse vide');
				ouvre_alerte("Erreur réseau !<br />Actualisation impossible...");
			}
			else
			{
					
				var trame2=buf.split("\n");
				console.log('Nombre de lignes reçues:', trame2.length);
				console.log('Première ligne:', trame2[0]);
				var code2= new Array(trame2.length);
				var statut2 = new Array(trame2.length);
				var nom2= new Array(trame2.length);
				var prenom2= new Array(trame2.length);
				var indicatif2= new Array(trame2.length);
				var longitude= new Array(trame2.length);
				var latitude= new Array(trame2.length);
				var etat= new Array(trame2.length);
				var iconId= new Array(trame2.length);
				var tel= new Array(trame2.length);
				var precision= new Array(trame2.length);
				var rapport= new Array(trame2.length);
				
				var documents_recus = new Object();
				
				for (i=0; i<trame2.length;i++)
				{
					if (!trame2[i] || trame2[i].trim() === '') {
						console.log('Ligne vide ignorée à l\'index', i);
						continue; // Ignorer les lignes vides
					}
					
					var temp2=trame2[i].split("><");
					console.log('Ligne', i, 'split en', temp2.length, 'éléments:', temp2);
					
					if (temp2.length < 12) {
						console.error('Erreur: Ligne', i, 'n\'a pas assez d\'éléments (attendu: 12, reçu:', temp2.length, ')');
						console.error('Contenu de la ligne:', trame2[i]);
						continue; // Ignorer les lignes invalides
					}
					
					code2[i]=temp2[0];
					statut2[i]=temp2[1];
					nom2[i]=temp2[2];
					prenom2[i]=temp2[3];
					indicatif2[i]=temp2[4];
					longitude[i]=temp2[5];
					latitude[i]=temp2[6];
					etat[i]=temp2[7];
					iconId[i]=temp2[8];
					tel[i]=temp2[9];
					precision[i]=temp2[10];
					rapport[i]=temp2[11];
					
					var Nug2=new Newusergroup(nom2[i]+" "+prenom2[i] , code2[i] ,null );
				
					usergroupList.push(Nug2);
					
					if (temp2[12]!=null)
					{
						var document_recu=temp2[12];
						if (document_recu!=" "){
							documents_recus[indicatif2[i]]=document_recu;
							//trace("Document reçu : "+document_recu);
						}else{
							//trace("Pas de document reçu !");
						}
					}else{
						//trace("Erreur document");
					}
					
				}
				
				console.log('Nombre de membres trouvés:', usergroupList.length);
				if (usergroupList.length>0){
					console.log('Appel de refresh_position_user avec', code2.length, 'membres');
					refresh_position_user(code2,statut2,indicatif2,latitude,longitude,etat,iconId,tel,nom2,prenom2,precision,rapport);
					zoomtofit(false);
    			}else{
					console.warn('Aucun membre trouvé dans usergroupList');
                    
					markerArray=new Array();
				}
				
				for (var k in documents_recus) {
    					var value = documents_recus[k];
    					var key = k;
						
						var repertoire=value;
						var repertoire_array=repertoire.split("/");
						var repertoire_photo_recu;
						if (repertoire_array.length>1){
							repertoire_photo_recu=repertoire_array[1];
							ouvre_infoboxSlidePhoto("ouvrir_galerie_utilisateur",2,"Réception de document",k+" vient de vous envoyer un document. Il a été automatiquement sauvegardé dans votre espace document. Voulez-vous visionner les documents de cet utilisateur ?","document",repertoire_photo_recu);
							user_pastille_a_afficher.push(repertoire_photo_recu);
						}
				}
				
            
			}
      })
  .fail(function(jqXHR, textStatus, errorThrown) {
      console.error('Erreur AJAX dans recherche_membre_activite:', textStatus, errorThrown);
      console.error('Response:', jqXHR.responseText);
      console.error('Status:', jqXHR.status);
      ouvre_alerte('Erreur réseau !<br />Problème technique...'); 
      
  })
  .always(function() {

  })
  ;
	
    timer_refresh_utilisateur_activite = setTimeout(function()
    {
        recherche_membre_activite(liste_des_codes);
    }, 2000);
    
}
function hideAllInfoWindows(map,code){
    
    markerArray.forEach(function(marker) {
        marker.info_w.close(map, marker);
  }); 
    if (!trace_polyline_user && code!="null"){
        
            efface_polyline_un_user_with_code(code);
        }
}
function refresh_position_user(code, statut,indicatif,latitude,longitude,etat,iconId,tel,nom,prenom,precision,rapport){
	
	if (memo_etat.length==0){
		for (i=0; i<indicatif.length;i++)
		{
			memo_etat[i]=etat[i];
			memo_statut[i]=statut[i];
			switch (parseInt(etat[i]))
			{
			case 0:
				value_etat="Aucun";
				break;
			case 1:
				value_etat="Opérationnel";
				break;
			case 2:
				value_etat="Départ";
				break;
			case 3:
				value_etat="Intervention en cours";
				break;
			case 4:
				value_etat="Retour d'intervention";
				if (rapport[i]===" ")
				{
					value_etat=value_etat+" - Pas de rapport d'intervention.";
				}else{
					value_etat=value_etat+" - Rapport d'intervention : " + rapport[i];
				}
				break;
			case 5:
				value_etat="URGENCE";
				break;
			default:
				value_etat="Aucun";
				break;
			};
			if (statut[i]=="actif"){
                
				ajoute_dans_historique($('#div_horloge').html()+","+"Statut initial de "+indicatif[i]+" : "+value_etat);
			}else{
				ajoute_dans_historique($('#div_horloge').html()+","+"Statut initial de "+indicatif[i]+" : inactif");
			}
			
		}
	}
	for (i=0; i<indicatif.length;i++)
	{
		switch (parseInt(etat[i]))
		{
		case 0:
			value_etat="Aucun";
			break;
		case 1:
			value_etat="Opérationnel";
			break;
		case 2:
			value_etat="Départ";
			break;
		case 3:
			value_etat="Intervention en cours";
			break;
		case 4:
			value_etat="Retour d'intervention";
			if (rapport[i]===" ")
				{
					value_etat=value_etat+" - Pas de rapport d'intervention disponible.";
				}else{
					value_etat=value_etat+" - Rapport d'intervention : " + rapport[i];
                    //ouvre_infoboxSlidePhoto("reception_rapport_intervention_utilisateur",1,"Réception d'un rapport d'intervention",indicatif[i]+" vient de vous envoyer un rapport d'intervention. Vous pouvez le consulter dans l'ihistorique de l'activité / mission.","document",null);
				}
			break;
		case 5:
			value_etat="URGENCE";
			break;
		default:
			value_etat="Aucun";
			break;
		};
		
		
		
		if (statut[i]==="actif"){
			if (memo_statut[i]==="inactif" && statut[i]==="actif"){
				ajoute_dans_historique($('#div_horloge').html()+","+"Changement de statut de "+indicatif[i]+" : actif");
			}
			if (memo_etat[i]!==etat[i]){
                
                if (rapport[i]!==" ")
                {
                    var rapp = rapport[i];
                    var rapport_multi_ligne_html=rapp.replace(/\\n/g, "<br />");
                    rapport_multi_ligne_html=rapport_multi_ligne_html.replace(/\\'/g, "'");
                    
                    ouvre_infoboxSlidePhoto("reception_rapport_intervention_utilisateur",1,"Réception d'un rapport d'intervention",indicatif[i]+" vient de vous envoyer un rapport d'intervention :<br /><br /><i>'"+ rapport_multi_ligne_html + "'</i>.<br /><br />Vous pouvez aussi le consulter dans l'historique de l'activité / mission.","document",null);
                }
                
				ajoute_dans_historique($('#div_horloge').html()+","+"Changement de statut de "+indicatif[i]+" : "+value_etat);
                
				if (value_etat==="Départ" && $('input[id=cbox_parametre_alerte_sonore]').is(':checked'))
				{
					active_alerte();
				}
                if (value_etat==="URGENCE" && $('input[id=cbox_parametre_alerte_sonore]').is(':checked'))
				{
					active_alerte();
				}
			}	
			
		}else{
			if (memo_statut[i]==="actif" && statut[i]==="inactif"){
				ajoute_dans_historique($('#div_horloge').html()+","+"Changement de statut de "+indicatif[i]+" : inactif");
			}
		}
	}
    
	//remove_user_marker();
	//console.log(markerArray.length);
	memo_etat=new Array();
	memo_statut=new Array();
    
	$('#menu_info_text').html('<p></p>');
	
    for (i=0; i<indicatif.length;i++)
	{
        var probleme_gps_user=false;
        if (parseFloat(latitude[i])==0 && parseFloat(longitude[i])==0){
            probleme_gps_user=true;
        }
        
		if (statut[i]==="actif" && !probleme_gps_user){
            
            var trouver=false;
             
            for (j=0;j<markerArray.length;j++){
                 if (markerArray[j].marker_id===code[i]){
                    trouver=true;
                    marker_temp_trouver=markerArray[j];
                    break;
                }
            }
            
            
			var latlng = new google.maps.LatLng(parseFloat(latitude[i]),parseFloat(longitude[i]));
			
            
            
            if (!trouver)
            {
                var temp_poi= create_marker(code[i],indicatif[i],latlng,parseInt(etat[i]),parseInt(iconId[i]),nom[i],prenom[i],tel[i],precision[i]);
            
                markerArray.push(temp_poi );
                
                temp_poi.setMap(map);
                
                
                create_polyline_user(code[i],latlng);

                //create_ligne_feux_user(code[i],latlng);
                                
                if (memo_poi_opener_infowindows!=null){

                    if (memo_poi_opener_infowindows==indicatif[i]){
                        google.maps.event.trigger(temp_poi, 'click')


                    }
                }
            }else{
                update_marker(marker_temp_trouver,code[i],indicatif[i],latlng,parseInt(etat[i]),parseInt(iconId[i]),nom[i],prenom[i],tel[i],precision[i]);
                
                    var trouver_poly=false;
                    var poly_temp_trouver;
                    for (j=0;j<polyline_user_array.length;j++){
                         if (polyline_user_array[j].poly_id===code[i]){
                            trouver_poly=true;
                            poly_temp_trouver=polyline_user_array[j];
                            break;
                        }
                    }
                    if (trouver_poly){
                        //alert('1');
                        update_polyline_user(poly_temp_trouver,latlng);
                    }else{
                         //alert('2');
                        create_polyline_user(code[i],latlng);

                    }
                    
                    var trouver_poly_ligne_feux=false;
                    var poly_ligne_feux_temp_trouver;
                    for (j=0;j<ligne_feux_user_array.length;j++){
                         if (ligne_feux_user_array[j].poly_id===code[i]){
                            trouver_poly_ligne_feux=true;
                            poly_ligne_feux_temp_trouver=ligne_feux_user_array[j];
                            break;
                        }
                    }
                    if (trouver_poly_ligne_feux){
                        //alert('1');
                        update_ligne_feux_user(poly_ligne_feux_temp_trouver,latlng);
                    }
                
            }
            
            
		}else{
            if (probleme_gps_user){
                $('#menu_info_text p').append( "<i><u>" +indicatif[i]+"</i></u> : problème de GPS, ");
            }else{
                $('#menu_info_text p').append("<i><u>" +indicatif[i]+"</i></u> : Inactif, ");
            }
			
            for (j=0;j<markerArray.length;j++){
                 if (markerArray[j].marker_id===code[i]){
                    
                    markerArray[j].setMap(null);
                    markerArray.splice(j, 1);
                     
                    break;
                }
            }
		}
	}
    
    /* on supprime les ligne de feux si l'utilisateur n'est plus là) */
    for (j=0;j<ligne_feux_user_array.length;j++){
        //console.log('************')
        var trouver_l_f=false;
        for (i=0;i<indicatif.length;i++){
            //console.log(ligne_feux_user_array[j].poly_id,code[i],statut[i])
            if (ligne_feux_user_array[j].poly_id===code[i] && statut[i] == 'actif'){
                trouver_l_f=true;
                //console.log('ok1')
                break;
                
            }
            
        }
        if (trouver_l_f==false){
            //console.log('ok2')
            efface_ligne_feux_un_user(ligne_feux_user_array[j])
        }
    }
   


	for (i=0; i<indicatif.length;i++)
	{
		memo_etat[i]=etat[i];
		memo_statut[i]=statut[i];
	}
    
	if ($('#menu_info_text p').html().length>2){
		$('#menu_info_text p').html($('#menu_info_text p').html().slice( 0, -2 ));
	}
	if ($('#menu_info_text p').html().lenght==0){
		$('#menu_info_text p').html("Tous les utilisateurs de l'activité sont actifs.");
	}
	zoomtofit(false);
}


function gere_couleur_etat(etat){
	var color_a_mettre='#ffffff';
		switch (etat)
			{
			case 0:
				color_a_mettre=Global.statut_color_0;
				break;
			case 1:
				color_a_mettre=Global.statut_color_1;
				break;
			case 2:
				color_a_mettre=Global.statut_color_2;
				break;
			case 3:
				color_a_mettre=Global.statut_color_3;
				break;
			case 4:
				color_a_mettre=Global.statut_color_4;
				break;
			case 5:
				color_a_mettre=Global.statut_color_5;
				break;
			default:
				color_a_mettre=Global.statut_color_0;
				break;
			};
		return color_a_mettre;
}
function active_alerte(){
    
	
	mySound_alarme.play();
}

var memo_map_bound = new google.maps.LatLngBounds();
var memo_bound = new google.maps.LatLngBounds();

function zoomtofit(force){
	
	if ($('#page_recherche').is(":visible") && $('#page_recherche').find('input[name=center_selected]').is(':checked')){
		return;
	}
	
	var centrage_sur_utilisateur=$('input[id=cbox_parametre_centrage_auto]').is(':checked');
	
	if (centrage_sur_utilisateur || force){
        
        if (markerArray.length==0 && markers_fixe_on_map.length==0 && marker_ma_position_on_map.length==0){
           // swal('Il n\'y a aucun marqueur sur la carte!','Centrage impossible.','error');
        }else{
            var bounds2 = new google.maps.LatLngBounds();
            
            
            for (var i = 0; i < markerArray.length; i++) {
                bounds2.extend(markerArray[i].getPosition());
            }
            for (var i = 0; i < markers_fixe_on_map.length; i++) {
                bounds2.extend(markers_fixe_on_map[i].getPosition());
            }
            for (var i = 0; i < marker_ma_position_on_map.length; i++) {
                bounds2.extend(marker_ma_position_on_map[i].getPosition());
            }
            if (bounds2.getNorthEast().equals(bounds2.getSouthWest())) {
               var extendPoint1 = new google.maps.LatLng(bounds2.getNorthEast().lat() + 0.01, bounds2.getNorthEast().lng() + 0.01);
               var extendPoint2 = new google.maps.LatLng(bounds2.getNorthEast().lat() - 0.01, bounds2.getNorthEast().lng() - 0.01);
               bounds2.extend(extendPoint1);
               bounds2.extend(extendPoint2);
            }

            if (!memo_map_bound.equals(map.getBounds()) || !memo_bound.equals(bounds2)){
                console.log('not equal')
                memo_map_bound = map.getBounds();
                memo_bound = bounds2;
                
                map.fitBounds(bounds2,100);    
                
            }    
            
            
        }
	}
}
function ferme_page_reglages(){
    $("#div_pour_page_parametres").slideUp('fast', function() {
        });
}
function ferme_page_a_propos(){
    $("#div_pour_page_a_propos").slideUp('fast', function() {
        });
}
function uniqId() {
  return Math.round(new Date().getTime() + (Math.random() * 1000));
}
function ouvre_infoboxSlidePhoto(id_alert,nb_button,t1,t2,logo,info_pass){
	
	
	mySound_message_recu.play();
	
	nb_slide_ouvert=nb_slide_ouvert+1;
	
	var unique_id_1=uniqId();
    var unique_id_2=uniqId();
    var unique_id_3=uniqId();
	
    var html_text='';
    
    
    
    html_text=html_text+'<div id="'+unique_id_1+'"><div id="id_view_alerte_reception_documents">';
    if (nb_slide_ouvert>1){
        html_text=html_text+'<hr />'
    }
    html_text=html_text+'<div style="position: absolute;right: 5px;top: 5px">';
    if(logo === "document"){
        html_text=html_text+'<img id="logo_document_recu" src="'+base_url+'images/button_documents.png" width="30" height="30"/>';
    }else{
        html_text=html_text+'<img id="logo_document_recu" src="'+base_url+'"images/button_documents.png" width="30" height="30"/>';
    }
    html_text=html_text+'</div>';
    html_text=html_text+'<div id="titre_alerte_reception_documents"><h2>'+t1+'</h2></div>';
    html_text=html_text+'<div id="message_alerte_reception_documents"><p>'+t2+'</p></div>';
    html_text=html_text+'<div style="text-align: center;">';
    if (nb_button==1){
        html_text=html_text+'<a href ="#" id="'+unique_id_2+'" class="bouton_fermer" style="width:100px;margin :0 auto;margin-bottom:5px;"> Ok </a>';
    }else if (nb_button==2){
        html_text=html_text+'<a href ="#" id="'+unique_id_3+'" class="bouton_fermer" style="width:100px;margin :0 auto;margin-bottom:5px;"> Oui </a>';
        html_text=html_text+'<a href ="#" id="'+unique_id_2+'" class="bouton_fermer" style="width:100px;margin :0 auto;"> Non </a>';
    }
    
    html_text=html_text+'</div>';
    html_text=html_text+'</div>';
    html_text=html_text+'</div>';
    
    $('#page_slide_alert_photo').append(html_text);
	$('#page_slide_alert_photo').show('fast');
    
    if (id_alert==="ouvrir_galerie_utilisateur"){
    
        $('#'+unique_id_2).click(function(){
            removeItemFromArray_user_pastille_a_afficher(info_pass);
            $('#'+unique_id_1).remove();
            nb_slide_ouvert=nb_slide_ouvert-1;
            if (nb_slide_ouvert==0){
                $('#page_slide_alert_photo').hide();
            }
        });
        $('#'+unique_id_3).click(function(){
            removeItemFromArray_user_pastille_a_afficher(info_pass);
            $('#'+unique_id_1).remove();
            nb_slide_ouvert=nb_slide_ouvert-1;
            if (nb_slide_ouvert==0){
                $('#page_slide_alert_photo').hide();
            }
            ouvre_page_document(info_pass);
        });    
    }
    if (id_alert==="reception_rapport_intervention_utilisateur"){
    
        $('#'+unique_id_2).click(function(){
            
            $('#'+unique_id_1).remove();
            nb_slide_ouvert=nb_slide_ouvert-1;
            if (nb_slide_ouvert==0){
                $('#page_slide_alert_photo').hide();
            }
        });
    }
}
function removeItemFromArray_user_pastille_a_afficher( item ){
	//trace("Array Original: " + user_pastille_a_afficher);
 
	// Array Lenght
	var arrayLenght = user_pastille_a_afficher.length;
 
	// Searches item in array
	for ( i =0; i<arrayLenght; i++ )
	{
		// Finds item and removes it
        if ( user_pastille_a_afficher[i] === item )
		{
           user_pastille_a_afficher.splice( i, 1 );
		   //trace("Item Removed: " + user_pastille_a_afficher[i]);
		   //trace("Array Updated: " + user_pastille_a_afficher);
        } 
    }
}

function ouvre_page_document(info_pass){
    window.open(base_url+'mes_documents?repertoire='+info_pass, '_blank');
}

function initAutocomplete() {
  
  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
      
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
        var n_marker=new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      })
      markers.push(n_marker);
        n_marker.addListener("click", function() {
            // Clear out the old markers.
            for (var i = 0; i < markers.length; i++) {
                    if (markers[i] === this) {
                        this.setMap(null);
                        markers.splice(i, 1);
                    }
                }
        });
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  // [END region_getplaces]
}


function affiche_lien_google_map(event){
    
    var lat = event.latLng.lat();
      lat = lat.toFixed(5);
      var lng = event.latLng.lng();
      lng = lng.toFixed(5);
    
    Swal.fire({
  title: '<strong>Coordonnées et lien Google Maps</strong>',
  icon: 'info',
  html:
        
    'Coordonnées géographique </br> <div id="coord_a_copier">' + lat + ', ' + lng + '</div></br><button type="button" class="bouton_infowindow" style ="display:inline" onclick="copy1()">Copier dans le presse papier</button> ' + '</br></br>' +
    'Lien Google Maps  </br> <div id="lien_a_copier">https://www.google.com/maps/place/' + lat + ',' + lng + '</div></br><button type="button" class="bouton_infowindow" style ="display:inline" onclick="copy2()">Copier dans le presse papier</button> ' ,
  showCloseButton: true,
  showCancelButton: false,
  focusConfirm: false,
  confirmButtonText:
    'Fermer'
})
}

function copy1() {
    var containerid='coord_a_copier';
    clearSelection();
    if (document.selection) {
    var range1 = document.body.createTextRange();
    range1.moveToElementText(document.getElementById(containerid));
    range1.select().createTextRange();
    document.execCommand("copy");

  } else if (window.getSelection) {
    var range1 = document.createRange();
    range1.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range1);
    document.execCommand("copy");
      //swal.close();
    swal({title:"Succès.",text:"Les coordonnées ont été copiées dans le presse-papier.",type:"success",timer:3000});
  }
  
}
function copy2() {
  var containerid='lien_a_copier';
    clearSelection();
    if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy");

  } else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
      //swal.close();
    swal({title:"Succès.",text:"Le lien Google Maps a été copié dans le presse-papier.",type:"success",timer:3000});
  }
}
function clearSelection()
{
 if (window.getSelection) {window.getSelection().removeAllRanges();}
 else if (document.selection) {document.selection.empty();}
}
/******************Affichage des coordonnées de la souris ************/

function cache_zone_texte_coordonnes(){
    if (!positionnement_marker_fixe_en_cours){
        //$("#zone_affichage_coordonnees").hide(200);
    }
    
}
function affiche_zone_texte_coordonnes(){
    //$("#zone_affichage_coordonnees").show(200);
}

function display_coordinate(event){
    displayCoordinates(event.latLng); 
}
function displayCoordinates(pnt) {

      var lat = pnt.lat();
      lat = lat.toFixed(4);
      var lng = pnt.lng();
      lng = lng.toFixed(4);
      //console.log("Lat: " + lat + " - Long: " + lng);


    var dmsCoords = ddToDms(lat, lng);
    //console.log("dmsCoords: " + dmsCoords);
    $("#zone_affichage_coordonnees").html("Lat: " + lat + " - Long: " + lng + "<br />" + dmsCoords);
  }

function affiche_position_marker_fix_in_drag(coord){

    displayCoordinates(coord); 
}

function ddToDms(lat, lng) {

   var lat = lat;
   var lng = lng;
   var latResult, lngResult, dmsResult;

   lat = parseFloat(lat);  
   lng = parseFloat(lng);

   latResult = (lat >= 0)? 'N' : 'S';

   // Call to getDms(lat) function for the coordinates of Latitude in DMS.
   // The result is stored in latResult variable.
   latResult += getDms(lat);

   lngResult = (lng >= 0)? 'E' : 'W';

   // Call to getDms(lng) function for the coordinates of Longitude in DMS.
   // The result is stored in lngResult variable.
   lngResult += getDms(lng);

   // Joining both variables and separate them with a space.
   dmsResult = latResult + ' - ' + lngResult;

   // Return the resultant string
   return dmsResult;
}

function getDms(val) {

  var valDeg, valMin, valSec, result;

  val = Math.abs(val);

  valDeg = Math.floor(val);
  result = valDeg + "º";

  valMin = Math.floor((val - valDeg) * 60);
  result += valMin + "'";

  valSec = Math.round((val - valDeg - valMin / 60) * 3600 * 1000) / 1000;
  result += valSec + '"';

  return result;
}
function verif_format_kml(path_of_file){
        
        if (path_of_file==="") {
        return 'bad';
        }
    
    
        if ( path_of_file.indexOf("dropbox.com") >= 0) { /********** DROPBOX ***********/

            if (path_of_file.indexOf("?dl=0")>=0) {

                return path_of_file.replace("?dl=0","?dl=1");

            } else if (path_of_file.indexOf("?dl=1")>=0) {
                return path_of_file;

            }

            } else if (path_of_file.indexOf("https://drive.google.com/file/d/")>=0) { 
                /********** GOOGLE DRIVE ***********/
                var file_id=path_of_file.replace("https://drive.google.com/file/d/","");
                
                var r1 = file_id.indexOf("/");
                var sub = file_id.substring(0,r1);
                
                return path_of_file = "https://drive.google.com/uc?export=download&id="+sub; 
        } else {
            return 'bad';
        }
        return 'bad';
    }

function ajout_trace_kml_enregistres(liens_kml){

    
        var array_kml = liens_kml.split('\n');
    
        //var url_kml=array_kml[i];

        if (array_kml.length>0){
            ajout_kml(array_kml,0);
        }
    
    
        
    
    }
function ajout_kml(array_kml,index){
    
    var url_kml_finale=verif_format_kml(array_kml[index]);

        if (url_kml_finale==='bad')
        {
            //swal('Importation impossible.','Le format de votre URL n\'est pas correct.','error');
                        index=index+1;
                        if (index<array_kml.length){
                            ajout_kml(array_kml,index);
                        }
        }else{

            var kmlLayer = new google.maps.KmlLayer({
            url: url_kml_finale,
            map: map,
                url_origine:array_kml[index]
            });

            
            
            google.maps.event.addListener(kmlLayer, 'status_changed', function() {

                google.maps.event.clearListeners(kmlLayer, 'status_changed');
                
                
                    if (kmlLayer.getStatus() != 'OK') {
                        //swal('Chargement du fichier KML / KMZ impossible !','Vérifiez votre url.','error');
                        index=index+1;
                        if (index<array_kml.length){
                            ajout_kml(array_kml,index);
                        }
                    } else {
                        //swal('Succès','Importation du fichier KML / KMZ réussie !','success');
                        kml_array.push(kmlLayer);
                        
                        index=index+1;
                        if (index<array_kml.length){
                            ajout_kml(array_kml,index);
                        }

                    }
                }); 
            }  
}
function remove_trace_kml(){
    for (i=0;i<kml_array.length;i++){
                    kml_array[i].setMap(null);
                    kml_array[i]=null;
                }
                kml_array=new Array();
}