<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penjualan  extends CI_Controller {
    
        public function index(){
            $this->load->model('penjualan_m');
		    $data['row'] =$this->penjualan_m->get();
            
            $this->load->view('template/template_header');
            
            $this->load->view('penjualan/view_penjualan',$data);
            $this->load->view('template/template_footer');
        }

        public function tampil($id){
            
            $this->load->model('penjualan_m');
            $this->load->model('barang_m');
		    $data['row'] =$this->penjualan_m->get();
            $data['row_barang'] =$this->barang_m->get();
           
            $query =$this->penjualan_m->get($id);
            if($query->num_rows()>0){
                $data['row']=$query->row();
                $this->load->view('template/template_header');
                $this->load->view('penjualan/tampil_transaksi',$data);
                $this->load->view('template/template_footer');
            }else{
                echo "<script> alert('Data Tidak Ditemukan');"; 
                echo "window.location='" .site_url('user_c'). "';</script>"; 
            }
            
            
        }
    }