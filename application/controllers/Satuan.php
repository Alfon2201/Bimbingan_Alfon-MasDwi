<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Satuan extends CI_Controller {
    
        public function index()
        {
            $this->load->view('template/template_header');
            $this->load->view('satuan/view_satuan');
            $this->load->view('template/template_footer');
        }
    
    }
    
    /* End of file Satuan.php */
    