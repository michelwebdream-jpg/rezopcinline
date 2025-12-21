<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller
{
    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();
        
        
    }
    
    public function index()
    {
        if ($this->session->userdata('login') || $this->session->userdata('logged')){
            
            redirect('signup/membres');
        }
        
        $this->form_validation->set_rules('text_input_mon_nom','Mon nom','trim|required');
        $this->form_validation->set_rules('text_input_mon_prenom','Mon prénom','trim|required');
        $this->form_validation->set_rules('text_input_mon_telephone','Mon téléphone','trim|required');
        $this->form_validation->set_rules('text_input_mon_mail','Mon e-mail','trim|required|valid_email|callback_compare_mail');
        $this->form_validation->set_rules('text_input_mon_mail2','Confirmer mon e-mail','trim|required|valid_email|callback_compare_mail');
        $this->form_validation->set_rules('text_input_mon_indicatif','Mon indicatif','trim|required');
        $this->form_validation->set_rules('text_input_mon_password1','Mon mot de passe','trim|required|min_length[5]|callback_compare_pass');
        $this->form_validation->set_rules('text_input_mon_password2','Confirmer mon mot de passe','trim|required|min_length[5]|callback_compare_pass');
        $this->form_validation->set_rules('text_input_cle_de_licence','Ma clé de licence','trim|required');
        
        
        if($this->form_validation->run())
        {
                $data = array(
                
                'text_input_mon_nom'=>$this->input->post('text_input_mon_nom'),
                'text_input_mon_prenom'=>$this->input->post('text_input_mon_prenom'),
                'text_input_mon_telephone'=>$this->input->post('text_input_mon_telephone'),
                'text_input_mon_mail'=>$this->input->post('text_input_mon_mail'),
                'text_input_mon_mail2'=>$this->input->post('text_input_mon_mail2'),
                'text_input_mon_indicatif'=>$this->input->post('text_input_mon_indicatif'),
                'text_input_mon_password1'=>$this->input->post('text_input_mon_password1'),
                'text_input_mon_password2'=>$this->input->post('text_input_mon_password2'),
                'text_input_cle_de_licence'=>$this->input->post('text_input_cle_de_licence'),
                'radio_button_icon_id'=>$this->input->post('marker')
            
                );
            
            $resultat_creation_de_compte=$this->signup_model->creer_compte_administrateur($data);
            
            if ($resultat_creation_de_compte!=FALSE){
            
                 $resultat_creation_de_compte = str_replace("return_txt=", "", $resultat_creation_de_compte);
                
                if (strpos($resultat_creation_de_compte,"ok")===0)
                {
                    $resultat_creation_de_compte=substr($resultat_creation_de_compte,2);

                    $code_administrateur=substr($resultat_creation_de_compte,0,8);
                    $date_fin_validite_licence=substr($resultat_creation_de_compte,8);
                    
                    $this->email->from('info@web-dream.fr','REZO+ PC Inline - Web-Dream');
                    $this->email->to($this->input->post('text_input_mon_mail'));
                    $this->email->subject('Confirmation de création de compte REZO+ PC Inline.');
                    $this->email->message("Bonjour,<br />vous trouverez ci-dessous les informations de connexions à votre compte REZO+.<br /><br />Code REZO+ : ".$code_administrateur."<br />"."Mot de passse : ".$this->input->post('text_input_mon_password1')."<br /><br />"."Adresse de connexion : <a href=\"http://www.web-dream.fr/rezopcinline\">REZO+ PC INLINE</a>"."<br /><br />"."Merci de votre confiance.<br />L'équipe Web-Dream");
            
                    $this->email->send();
            
                    $data['titre']='REZO+ PC INLINE | Créer un compte';
                    $data['heading']='Bienvenue dans REZO+ PC InLine';
                    $data['footing']='copyrigth@2017 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                    $data['code_administrateur']=$code_administrateur;
                    $data['date_fin_validite_licence']=$date_fin_validite_licence;
                    $this->load->view('succes_creation_compte',$data);

                }else if ($resultat_creation_de_compte=="1"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur de compte !<br />Cette adresse mail est déjà enrergistrée sur un autre compte. Création du compte impossible...");
                }else if ($resultat_creation_de_compte=="2"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur de licence !<br />Cette clé licence est associée à un autre compte. Création du compte impossible.");
                }else if ($resultat_creation_de_compte=="3"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur de licence !<br />Cette clé de licence n'existe pas. Création du compte impossible.");
                }else if ($resultat_creation_de_compte=="4"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur de licence !<br />Cette clé de licence est déjà active. Création du compte impossible.");
                }else if ($resultat_creation_de_compte=="5"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur de licence !<br />Cette clé de licence a expirée. Création du compte impossible.");
                }else if ($resultat_creation_de_compte=="6"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur système !<br />Création du compte impossible.");
                }else if ($resultat_creation_de_compte=="-1"){
                    $this->retourne_une_erreur_au_formulaire_signup("Erreur de licence !<br />Création du compte impossible.");
                }
            }else{
                $this->retourne_une_erreur_au_formulaire_signup('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
            }
         }else{
            $data['titre']='REZO+ PC INLINE | Créer un compte';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyrigth@2017 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $this->load->view('signup',$data);
        }
    }
    
    function login(){
        
        if ($this->session->userdata('login') || $this->session->userdata('logged')){
            
            redirect('signup/membres');
        }
        
        $this->form_validation->set_rules('code','Code REZO+','trim|required');
        $this->form_validation->set_rules('pass','Mot de passe','trim|required');
        
        if($this->form_validation->run())
        {
            $resultat_verif_code_et_licence=$this->signup_model->check_code_et_licence($this->input->post('code'),$this->input->post('pass'));
            
            if ($resultat_verif_code_et_licence!=FALSE){
                
                $resultat_verif_code_et_licence = str_replace("return_txt=", "", $resultat_verif_code_et_licence);
                                
                if ($resultat_verif_code_et_licence==""){
                    $this->retourne_une_erreur_au_formulaire('Erreur réseau !<br />Lecture des informations impossible...');
				}else if ($resultat_verif_code_et_licence=="-1")
                {
                    $this->retourne_une_erreur_au_formulaire('Erreur de licence !<br />Clé de licence expirée! <br />Veuillez renouveller votre clé de licence sur le site www.web-dream.fr"');
                }else if ($resultat_verif_code_et_licence=="-2")
                {
                    $this->retourne_une_erreur_au_formulaire('Erreur !<br />Le code et/ou le mot de passe sont incorrects');
                    
                }else if ($resultat_verif_code_et_licence=="-3")
                {
                    $this->retourne_une_erreur_au_formulaire('Erreur !<br />Clé de licence inactive!');
                    
                }
                else
                {
                    

                    $verifie_si_code_pc_dans_table_pc = $this->signup_model->test_si_code_pc_dans_table_contact($this->input->post('code'));
                    
                    if ($verifie_si_code_pc_dans_table_pc!=FALSE){
                        
                        $mise_a_jour_galerie_photo = $this->signup_model->mise_a_jour_pour_galerie_photo($this->input->post('code'));
                        
                        if ($mise_a_jour_galerie_photo!=FALSE){
                            
                            $temp=explode("><",$resultat_verif_code_et_licence);

                            $deliveryData = array(
                                'code_administrateur' => $temp[0],
                                'nom_administrateur' => $temp[1],
                                'prenom_administrateur' => $temp[2],
                                'telephone_administrateur' => $temp[3],
                                'mail_administrateur' => $temp[4],
                                'indicatif_administrateur' => $temp[5],
                                'icone_administrateur' => $temp[6],
                                'etat_administrateur' => $temp[7],
                                'date_fin_validite_licence' => $temp[8],
                                'date_creation_compte_administrateur' => $temp[9]
                            );



                            $data=array('login'=>$this->input->post('code'),'logged'=>true,'deliverdata'=>$deliveryData);

                            $this->session->set_userdata($data);
                            
                            redirect('signup/membres');
                            
                        }else{
                            $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
                        }
                    }else{
                        $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
                    }
                }
            }else{
                $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
            }
        }else{
            $data['titre']='REZO+ PC INLINE | Connexion';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyrigth@2017 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $this->load->view('login',$data);
        }
        
    }
    
    function retourne_une_erreur_au_formulaire_signup($_message){
            $data['error']=$_message;
            $data['titre']='REZO+ PC INLINE | Créer un compte';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyrigth@2017 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $this->load->view('signup',$data);
    }
    function retourne_une_erreur_au_formulaire($_message){
                $data['error']=$_message;
                $data['titre']='REZO+ PC INLINE | Connexion';
                $data['heading']='Bienvenue dans REZO+ PC InLine';
                $data['footing']='copyrigth@2017 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
                $this->load->view('login',$data);
    }
    function logout(){
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('deliverdata');
        $this->session->sess_destroy();
        redirect(site_url());
        
    }
    
    function membres(){
        if (!$this->session->userdata('login') || !$this->session->userdata('logged')){
            redirect(site_url());
        }else{
            redirect('membres');
        }
    }
    
    // fonction de callback
    function compare_mail(){
        if ($this->input->post('text_input_mon_mail') && $this->input->post('text_input_mon_mail2')){
            
            if ($this->input->post('text_input_mon_mail') != $this->input->post('text_input_mon_mail2')){
                $this->form_validation->set_message('compare_mail','Les emails ne sont pas identiques !');
                return false;
            }else{
                return true;
            }
        }
    }
    function compare_pass(){
        if ($this->input->post('text_input_mon_password1') && $this->input->post('text_input_mon_password2')){
            
            if ($this->input->post('text_input_mon_password1') != $this->input->post('text_input_mon_password2')){
                $this->form_validation->set_message('compare_pass','Les mots de passe ne sont pas identiques !');
                return false;
            }else{
                return true;
            }
        }
    }
    
    
}