<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Peramalan  extends CI_Controller {
    
        public function index(){
            
            
            $this->load->view('template/template_header');
            
            $this->load->view('peramalan/View');
            $this->load->view('template/template_footer');
        }

        
    }