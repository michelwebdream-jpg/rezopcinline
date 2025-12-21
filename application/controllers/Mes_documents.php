<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mes_documents extends CI_Controller
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
        
        if ( isset($_GET['repertoire']) ) {
            $data['repertoire_a_ouvrir']= $_GET['repertoire'];
        }else{
            $data['repertoire_a_ouvrir']= '';
        }
        
            //$data['repertoire_a_ouvrir']='';
            $data['titre']='REZO+ PC INLINE | Mes documents';
            $data['heading']='Bienvenue dans REZO+ PC InLine';
            $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
            $data['utilisateur']=$this->session->userdata('deliverdata');
            $this->load->view('mes_documents',$data);
        
    }
    
}