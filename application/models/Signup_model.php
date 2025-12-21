<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_model extends CI_Model
{
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        
        
    }
    
    function envoi_mot_de_passe($_data){
        $passData = $_data;
        
        $url = APP_SERVER_URL.SENDPASSWORD_URI;
        //$url = 'http://wwwd.web-dream.fr/dev/rezo_flash_code/update_password.php';

        return $this->postCURL($url, $passData);
    }
    
    function modifier_mot_de_passe($_data){
        $passData = $_data;
        
        $url = APP_SERVER_URL.UPDATEPASSWORD_URI;
        //$url = 'http://wwwd.web-dream.fr/dev/rezo_flash_code/update_password.php';

        return $this->postCURL($url, $passData);
    }
    
    function update_compte_administrateur($_data){
        
        $passData = $_data;
        
        $url = APP_SERVER_URL.UPDATEUSER_URI;
        //$url = 'http://wwwd.web-dream.fr/dev/rezo_flash_code/updateuser_customer.php';

        return $this->postCURL($url, $passData);
    }
    
    public function check_code_et_licence($code,$pass)
    {
        $passData = array(
           "mon_code" => $code,
           "mon_mot_de_passe" => $pass
        );
        $url = APP_SERVER_URL.LIT_INFO_ADMINISTRATEUR_URI;
        
        //$url = 'http://www.web-dream.fr/dev/rezo_flash_code/lit_info_administrateur.php';

        return $this->postCURL($url, $passData);
    }
    function test_si_code_pc_dans_table_contact($code){
        $passData = array(
           "mon_code" => $code
        );
        $url = APP_SERVER_URL.AJOUTE_CODE_PC_TABLE_CONTACT_URI;
        //$url = 'http://www.web-dream.fr/dev/rezo_flash_code/ajoute_code_pc_table_contact.php';

        return $this->postCURL($url, $passData);
    }
    function mise_a_jour_pour_galerie_photo($code){
        $passData = array(
           "code_PC" => $code,
            "size_limit_galerie" => "100",
            "appli_type_PC" => "3"
        );
        $url = APP_SERVER_URL.MAJ_APP_POUR_GALERIE_PHOTO_URI;
        //$url = 'http://www.web-dream.fr/dev/rezo_flash_code/maj_app_pour_galerie_photo.php';

        return $this->postCURL($url, $passData);
    }
    
    function creer_compte_administrateur($_data){
        
        $passData = array(
            "mon_nom" => $_data['text_input_mon_nom'],
            "mon_prenom" => $_data['text_input_mon_prenom'],
            "mon_telephone" => $_data['text_input_mon_telephone'],
            "mon_mail" => $_data['text_input_mon_mail'],
            "mon_indicatif" => $_data['text_input_mon_indicatif'],
            "mon_iconid" => $_data['radio_button_icon_id'],
            "mon_password" => $_data['text_input_mon_password1'],
            "ma_licence" => $_data['text_input_cle_de_licence']
        );
        $url = APP_SERVER_URL.REGISTER_URI;
        //$url = 'http://www.web-dream.fr/dev/rezo_flash_code/creat_customer.php';

        return $this->postCURL($url, $passData);
    }
    
   /* public function postCURL($_url, $_param){

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');

try {
        $ch = curl_init();
        
        if (FALSE === $ch)
        throw new Exception('failed to initialize');
        
        
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_USERAGENT, TRUE);

        $output=curl_exec($ch);

    if (FALSE === $output)
        throw new Exception(curl_error($ch), curl_errno($ch));
    
        curl_close($ch);

} catch(Exception $e) {

trigger_error(sprintf(
'Curl failed with error #%d: %s',
$e->getCode(), $e->getMessage()),
E_USER_ERROR);
    
    die;

}
    
    
        return $output;
    }*/
    
    
    public function postCURL($_url, $_param){

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_USERAGENT, TRUE);

        $output=curl_exec($ch);

        curl_close($ch);

        
        return $output;
    }
}