<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Barang extends CI_Controller {
    
        public function index(){
            $this->load->model('barang_m');
		    $data['row'] =$this->barang_m->get();
            
            $this->load->view('template/template_header');
            
            $this->load->view('barang/view_barang',$data);
            $this->load->view('template/template_footer');
        }

        

        

		
		
    
    }
    
    /* End of file Barang.php */
    