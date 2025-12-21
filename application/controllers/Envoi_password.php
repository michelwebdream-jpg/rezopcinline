<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Envoi_password extends CI_Controller
{
    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        
        
    }
    
    public function index()
    {
        
        
         $this->form_validation->set_rules('text_input_mon_email','Mon adresse email','trim|required|valid_email');
         
        if($this->form_validation->run())
        {
            $data = array(
                
                'mon_email'=>$this->input->post('text_input_mon_email'),
                
                );
            
            $resultat_envoi_password=$this->signup_model->envoi_mot_de_passe($data);
            
            if ($resultat_envoi_password!=FALSE){
                
                if ($resultat_envoi_password=="1"){
                    $data['succes']='Votre code et mot de passe ont bien étés envoyés à votre adresse email.';
                    $data['titre']='REZO+ PC INLINE | Mon compte';
                    $data['heading']='Bienvenue dans REZO+ PC InLine';
                    $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                    $this->load->view('envoi_password',$data);
                }else{
                    //$this->retourne_une_erreur_au_formulaire('test : '.$resultat_envoi_password);
                    $this->retourne_une_erreur_au_formulaire('Erreur.<br />Cette adresse email n\'existe pas.');
                }
                
            }else{
                $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
            }
        }
        else{
            $data['titre']='REZO+ PC INLINE | Envoyer mon code et mon mot de passe';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $this->load->view('envoi_password',$data);
        }
    }
    function retourne_une_erreur_au_formulaire($_message){
                $data['error']=$_message;
                $data['titre']='REZO+ PC INLINE | Envoyer mon code et mon mot de passe';
                $data['heading']='Bienvenue dans REZO+ PC InLine';
                $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                $this->load->view('envoi_password',$data);
    }
}