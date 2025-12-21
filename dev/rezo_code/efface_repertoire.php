<?PHP


header('Expires: Thu, 01 Jan 1970 00:00:00 GMT, -1');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        
        throw new InvalidArgumentException("not a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        
        if (is_dir($file)) {
            
            deleteDir($file);
        } else {
            
            unlink($file);
        }
    }
    
    rmdir($dirPath);
}



if  (isset($_POST['repertoire_a_supprimer']))
{
    $repertoire_a_supprimer=$_POST['repertoire_a_supprimer'];
   // $repertoire_a_supprimer= utf8_encode($repertoire_a_supprimer);
					//echo 'repertoire : '. $repertoire_a_supprimer;
    if (is_dir("../rezo_galerie/".$repertoire_a_supprimer)) {
        deleteDir("../rezo_galerie/".$repertoire_a_supprimer);
        echo "1";
    }else{
        echo "-1";
    }
     
}else{
    echo "-2";
}



?>