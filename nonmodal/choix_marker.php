<?php $burl=$_POST['burl']; ?>

<div id="id_view_choix_marker">
<h1 style=" overflow: hidden; float: left;">Ma position / Marqueurs fixes / Fichier KML et KMZ</h1>
    <div id="curseur_pour_deplacer_page" class="curseur_pour_deplacer_page_class" style="float:right;display: flex;align-items: center;margin-left:8px;cursor:pointer;"><img src="<?php echo $burl; ?>images/bouton_move.png" />
    </div>
    <div style="float:right;display: flex;align-items: center;"><a href ="#" id="bouton_fermer_non_modal" class="bouton_fermer"> Fermer </a>
    </div><div class="separator"></div>
    <hr />
  

<table border="0" style="border-collapse:collapse;">
    <tr>
    <td  valign="bottom">
        <details close>
          <summary>Ajout de marqueurs fixes sur la carte. Instructions</summary>
          <p style="text-align:center;font-size:14px;">Pour placer un marqueur sur la carte, cliquez sur un symbole puis déplacez-le sur la carte. Cliquez de nouveau pour le positionner. Pendant le déplacement, vous pouvez annuler l'action en effectuant un click droit avec la souris.<br />Pour le supprimer ou le renomer, cliquer une fois dessus. Pour déplacer un marqueur sur la carte,<br />cliquez sur le marqueur et sans relacher le bouton de la souris, déplacez-le.</p>
        </details>
        
        </td>
        <td width="10" rowspan="2" align="center" valign="middle" ></td>
        <td valign="bottom">
            <details close>
          <summary>Importation de tracés cartographiques - Instructions.</summary>
          <p>Entrez le lien Dropbox, Google Drive ou autre lien de téléchargement direct de votre fichier KML /KMZ. </p>
                    <p>Exemples de liens :<br />
                    Dropbox : https://www.dropbox.com/s/dghihxnobtfic90/KML_Sample.kml?dl=0<br />
                    Google Drive : https://drive.google.com/file/d/0B6FsKvWjddoQekFrMlpHREJJNEE/view?usp=sharing<br />
                    Custom : https://my.domain.com/my_file.kml</p>
        </details>
        
        </td>
    </tr>
<tr>
    <td>
    <table border="0" style="border-collapse:collapse;">
                  <tr>
                    <td rowspan="2" align="center" valign="middle" style="background:#aaaaaa;padding:20px;"><div class="class_marker_a_deplacer" id="id_marker_ma_position"><span style="margin-bottom:5px;display:block;">Ma position</span><img src='<?php echo $burl; ?>images/marker_administrateur.png' /></div></td>
                    <td width="10" rowspan="2" align="center" valign="middle" ></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src='<?php echo $burl; ?>images/marker_user_1.png' /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_2.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_3.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_4.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_5.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_6.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_7.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_8.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_9.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_10.png" /></div></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_11.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_12.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_13.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_14.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_15.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_16.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_17.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_18.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_19.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_20.png" /></div></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_21.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_22.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_23.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_24.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_25.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_26.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_27.png" /></div></td>
                    <td align="center" valign="top" style="background:#aaaaaa;padding:5px;"><div class="class_marker_a_deplacer"><img src="<?php echo $burl; ?>images/marker_user_28.png" /></div></td>
                  </tr>
                  
</table>  
    </td>
    <td align="center" valign="top" style="background:#aaaaaa;padding:20px;">
  
        <label for="my-url_kml_file" class="input-file-trigger" tabindex="0" style="display:inline-block;margin-top:10px;">Importer un fichier au format KML / KMZ</label>
        <a href="https://www.web-dream.fr/app/aide-limportation-de-traces-cartographiques-rezo-pc-inline/" target="_blank">
<img border="0" alt="Aide" src="images/help_green.png" width="30" height="30" style="vertical-align: middle;">
</a>
        
        <input type="text" id="url_kml_file" name="url_kml_file"  style="width:100%;margin-bottom:15px;"/>
        <a href="#" id="bouton_valider_url_kml" class="bouton_fermer" style="display: inline-block;"> Importer </a>
    
        <div id="container_couche_kml"></div>    
    
        <a href="#" id="bouton_effacer_kml" class="bouton_fermer" style="margin-top:15px;"> Effacer tous les tracés KML / KMZ</a>
        
    </td>
    </tr>
</table>
<script>
    
$(document).ready( function () {
    
    affiche_bouton_couche_kml();
    
    $('#bouton_effacer_kml').click(function(){
        
        
        swal({   title: "ATTENTION !",   text: "Êtes-vous sûr de vouloir effacer toutes les couches KML ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Oui",   cancelButtonText: "Non", closeOnConfirm: true }, function(){   
                for (i=0;i<kml_array.length;i++){
                    kml_array[i].setMap(null);
                    kml_array[i]=null;
                }
                kml_array=new Array();
                affiche_bouton_couche_kml();
        });       
    });
    
    $('#bouton_valider_url_kml').click(function() {
    
        var url_kml=$('#url_kml_file').val();

        var url_kml_finale=verif_format_kml(url_kml);

        if (url_kml_finale==='bad')
        {
            swal('Importation impossible.','Le format de votre URL n\'est pas correct.','error');

        }else{

            var kmlLayer = new google.maps.KmlLayer({
            url: url_kml_finale,
            map: map,
                url_origine:url_kml
            });

            
            
            google.maps.event.addListener(kmlLayer, 'status_changed', function() {

                google.maps.event.clearListeners(kmlLayer, 'status_changed');
                
                
                    if (kmlLayer.getStatus() != 'OK') {
                        swal('Chargement du fichier KML / KMZ impossible !','Vérifiez votre url.','error');

                    } else {
                        swal('Succès','Importation du fichier KML / KMZ réussie !','success');
                        kml_array.push(kmlLayer);
                        affiche_bouton_couche_kml();

                    }
                }); 
            }
            
            
    
    });
    
    function affiche_bouton_couche_kml(){
        
        $("#container_couche_kml").html('');
        
        for (i=0;i<kml_array.length;i++){
        
            //google.maps.event.clearInstanceListeners(kml_array[i]);
            
            var text1='';
            
            if (kml_array[i].getMap() == null) {
                text1='<div class="bouton_couche_kml b_inactive" id="bouton_couche_kml_' + i + '">Couche KML ' + (i+1) + ' inactive<br/><span style="font-size:10px">' + kml_array[i].url_origine + '</span></div>';
            }else{
                text1='<div class="bouton_couche_kml b_active" id="bouton_couche_kml_' + i + '">Couche KML ' + (i+1) + ' active<br/><span style="font-size:10px">' + kml_array[i].url_origine + '</span></div>';
            }
            
            
            $("#container_couche_kml").append(text1);
            
            $('#bouton_couche_kml_'+i).click(function(){
                var my_id=$(this).attr('id');
                my_id=my_id.replace('bouton_couche_kml_','');
                my_id=parseInt(my_id);
                
                
                if (kml_array[my_id].getMap() == null) {
                    //alert('0');
                    kml_array[my_id].setMap(map);
                    $(this).removeClass('b_inactive').addClass('b_active');
                    $(this).html('Couche KML ' + (my_id+1) + ' active<br/><span style="font-size:10px">' + kml_array[my_id].url_origine + '</span>');
                  } else {
                      //alert('1');
                    kml_array[my_id].setMap(null);
                    $(this).removeClass('b_active').addClass('b_inactive');
                      $(this).html('Couche KML ' + (my_id+1) + ' inactive<br/><span style="font-size:10px">' + kml_array[my_id].url_origine + '</span>');
                  }
            });
            
            
        }
    }
    
    
});

    
</script>

    