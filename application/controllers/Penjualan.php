<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penjualan  extends CI_Controller {
    
        public function index(){
            $this->load->model('barang_m');
		    $data['row'] =$this->barang_m->get();
            
            $this->load->view('template/template_header');
            
            $this->load->view('penjualan/transaksi_form_add',$data);
            $this->load->view('template/template_footer');
        }

        public function tampil(){
            $this->load->model('barang_m');
		    $data['row'] =$this->barang_m->get();
            
            $this->load->view('template/template_header');
            
            $this->load->view('penjualan/tampil_transaksi',$data);
            $this->load->view('template/template_footer');
        }
    }