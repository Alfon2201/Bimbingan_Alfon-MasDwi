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
        
        public function tambah()
        {	
            $this->load->model('barang_m');
            $data['row'] =$this->barang_m->get();
            //print_r($_POST['level']);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('kode','Kode Barang','required');
            $this->form_validation->set_rules('barang','Nama Barang','required');
            $this->form_validation->set_rules('stok','Stok Barang','required');
           
            
            $this->form_validation->set_rules('beli','Harga Beli','required');
            $this->form_validation->set_rules('jual','Harga Jual','required');
            $this->form_validation->set_message('required', '%s Masih kosong silakan isi');
            
            
            //belum ke baca
            $this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');
            if($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('template/template_header');
                $this->load->view('barang/barang_form_add',$data);
                $this->load->view('template/template_footer');
            }else 
                {
                    $post = $this->input->post(null, TRUE);
                    $this->barang_m->add($post);
                        // if($this->db->affected_rows() >0)
                        // {
                        //     echo "<script> 
                        //         alert('Data Berhasil Disimpan');
                        //     </script";
                        // }
                   
                        // echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                        echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                        
                }
            }            
            
    public function edit($id)
	{	
        $this->load->model('barang_m');
        $data['row'] =$this->barang_m->get();
        //print_r($_POST['level']);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode','Kode Barang','required');
        $this->form_validation->set_rules('barang','Nama Barang','required');
        $this->form_validation->set_rules('stok','Stok Barang','required');
       
        
        $this->form_validation->set_rules('beli','Harga Beli','required');
        $this->form_validation->set_rules('jual','Harga Jual','required');
        $this->form_validation->set_message('required', '%s Masih kosong silakan isi');
		
		//belum ke baca
		
        if($this->form_validation->run() == FALSE)
        {
            $query =$this->barang_m->get($id);
            if($query->num_rows()>0){
                $data['row']=$query->row();
                $this->load->view('template/template_header');
                $this->load->view('barang/barang_form_edit',$data);
                $this->load->view('template/template_footer');
            }else{
                echo "<script> alert('Data Tidak Ditemukan');"; 
                echo "window.location='" .site_url('barang'). "';</script>"; 
            }
            
        }else 
            {
                $post = $this->input->post(null, TRUE);
                $this->barang_m->edit($post);
                    // if($this->db->affected_rows() >0)
                    // {
                    //     echo "<script> 
                    //         alert('Data Berhasil Disimpan');
                    //     </script";
                    // }
               
                    // echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                    echo "<script>window.location='" .site_url('barang'). "';</script>"; 
                    
            }
    }
        

        

		
		
    
    }
    
    /* End of file Barang.php */
    