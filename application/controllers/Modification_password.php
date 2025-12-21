<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modification_password extends CI_Controller
{
    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        
        
    }
    
    public function index()
    {
        if (!$this->session->userdata('login') || !$this->session->userdata('logged')){
            
            redirect('signup/login');
        }
        
        $this->form_validation->set_rules('text_input_mon_password_actuel','Mon mot de passe actuel','trim|required|min_length[5]');
        $this->form_validation->set_rules('text_input_mon_password_new','Mon nouveau mot de passe','trim|required|min_length[5]');
         
        if($this->form_validation->run())
        {
            $utilisateur=$this->session->userdata('deliverdata');
            $mon_code=$utilisateur['code_administrateur'];
            
            $data = array(
                
                'mon_code'=>$mon_code,
                'mon_password_actuel'=>$this->input->post('text_input_mon_password_actuel'),
                'mon_password_new'=>$this->input->post('text_input_mon_password_new')
                
                );
            
            $resultat_modifier_password=$this->signup_model->modifier_mot_de_passe($data);
            
            if ($resultat_modifier_password!=FALSE){
                
                if ($resultat_modifier_password=="1"){
                    $data['succes']='Votre mot de passe a bien été mis à jour. Vous devrez utiliser votre nouveau mot de passe lors de votre prochaine connexion.';
                    $data['titre']='REZO+ PC INLINE | Mon compte';
                    $data['heading']='Bienvenue dans REZO+ PC InLine';
                    $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                    $data['utilisateur']=$this->session->userdata('deliverdata');
                    $this->load->view('mon_compte',$data);
                }else{
                    $this->retourne_une_erreur_au_formulaire('Erreur.<br />Le mot de passe actuel saisie ne correspond pas à votre mot de passe.');
                }
                
            }else{
                $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
            }
        }
        else{
            $data['titre']='REZO+ PC INLINE | Modifier mon mot de passe';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $data['utilisateur']=$this->session->userdata('deliverdata');
            $this->load->view('modification_password',$data);
        }
    }
    function retourne_une_erreur_au_formulaire($_message){
                $data['error']=$_message;
                $data['titre']='REZO+ PC INLINE | Modifier mon mot de passe';
                $data['heading']='Bienvenue dans REZO+ PC InLine';
                $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                $data['utilisateur']=$this->session->userdata('deliverdata');
                $this->load->view('modification_password',$data);
    }
}