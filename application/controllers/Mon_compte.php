<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mon_compte extends CI_Controller
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
        
        $this->form_validation->set_rules('text_input_mon_nom','Mon nom','trim|required');
        $this->form_validation->set_rules('text_input_mon_prenom','Mon prénom','trim|required');
        $this->form_validation->set_rules('text_input_mon_telephone','Mon téléphone','trim|required');
        
        $this->form_validation->set_rules('text_input_mon_indicatif','Mon indicatif','trim|required');
        
        if($this->form_validation->run())
        {
            $utilisateur=$this->session->userdata('deliverdata');
            $mon_code=$utilisateur['code_administrateur'];
            $mon_mail=$utilisateur['mail_administrateur'];
            $data = array(
                
                'mon_code'=>$mon_code,
                'mon_nom'=>$this->input->post('text_input_mon_nom'),
                'mon_prenom'=>$this->input->post('text_input_mon_prenom'),
                'mon_telephone'=>$this->input->post('text_input_mon_telephone'),
                'mon_mail'=> $mon_mail,
                'mon_indicatif'=>$this->input->post('text_input_mon_indicatif'),
                'mon_iconid'=>$this->input->post('marker')
            
                );
            
            $resultat_update_compte=$this->signup_model->update_compte_administrateur($data);
            
            if ($resultat_update_compte!=FALSE){
                
                
                $mes_infos=$this->session->userdata('deliverdata');
                
                $deliveryData = array(
                                'code_administrateur' => $mon_code,
                                'nom_administrateur' => $this->input->post('text_input_mon_nom'),
                                'prenom_administrateur' => $this->input->post('text_input_mon_prenom'),
                                'telephone_administrateur' => $this->input->post('text_input_mon_telephone'),
                                'mail_administrateur' => $mon_mail,
                                'indicatif_administrateur' => $this->input->post('text_input_mon_indicatif'),
                                'icone_administrateur' => $this->input->post('marker'),
                                'etat_administrateur' => $mes_infos['etat_administrateur'],
                                'date_fin_validite_licence' => $mes_infos['date_fin_validite_licence'],
                                'date_creation_compte_administrateur' => $mes_infos['date_creation_compte_administrateur']
                            );



                $data_user=array('login'=>$this->session->userdata('login'),'logged'=>true,'deliverdata'=>$deliveryData);
                $this->session->set_userdata($data_user);
                
                $data['succes']='Votre compte à bien été mis à jour.';
                $data['titre']='REZO+ PC INLINE | Mon compte';
                $data['heading']='Bienvenue dans REZO+ PC InLine';
                $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                $data['utilisateur']=$this->session->userdata('deliverdata');
                $this->load->view('mon_compte',$data);
            }else{
                $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
            }
        }
        else{
            $data['titre']='REZO+ PC INLINE | Mon compte';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $data['utilisateur']=$this->session->userdata('deliverdata');
            $this->load->view('mon_compte',$data);
        }
    }
    function retourne_une_erreur_au_formulaire($_message){
                $data['error']=$_message;
                $data['titre']='REZO+ PC INLINE | Mon compte';
                $data['heading']='Bienvenue dans REZO+ PC InLine';
                $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                $data['utilisateur']=$this->session->userdata('deliverdata');
                $this->load->view('mon_compte',$data);
    }
}