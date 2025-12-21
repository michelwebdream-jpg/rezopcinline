<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');





if  (isset($_POST['repertoire_a_supprimer']) && isset($_POST['fichier_a_supprimer']))
{
    $repertoire_a_supprimer=$_POST['repertoire_a_supprimer'];
    $fichier_a_supprimer=$_POST['fichier_a_supprimer'];

					
    if (file_exists("../rezo_galerie/".$repertoire_a_supprimer."/".$fichier_a_supprimer)) {
        unlink("../rezo_galerie/".$repertoire_a_supprimer."/".$fichier_a_supprimer);
        if (file_exists("../rezo_galerie/".$repertoire_a_supprimer."/thumb/".$fichier_a_supprimer)) {
            unlink("../rezo_galerie/".$repertoire_a_supprimer."/thumb/".$fichier_a_supprimer);
        }
        echo "1";
    }else{
        echo "-1";
    }
     
}else{
    echo "-2";
}



?>