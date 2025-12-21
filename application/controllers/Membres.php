<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membres extends CI_Controller
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
        
        // Load the library 
        $this->load->library('googlemaps');
        // Initialize our map. Here you can also pass in additional parameters for customising the map (see below) 
        
        $config['center'] = 'France';
        $config['zoom'] = '5';
        
        $this->googlemaps->initialize($config);
        
                
        // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be // placed where we want the map to appear.
        $data['map'] = $this->googlemaps->create_map();
        
        $data['titre']='REZO+ PC INLINE';
        $data['heading']='Bienvenue dans REZO+ PC InLine';
        $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
        $data['base_url']=base_url();
        $data['utilisateur']=$this->session->userdata('deliverdata');
        $this->load->view('template/template_main',$data);
        
    }
    
    public function mon_compte()
    {
        if (!$this->session->userdata('login') || !$this->session->userdata('logged')){
            
            redirect('signup/login');
        }
        
        $data['titre']='REZOPCINLINE';
        $data['heading']='Mon compte';
        $data['content']="mon_compte";
        $data['footing']='copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>';
        
        $this->load->view('template/template',$data);
        
    }
}