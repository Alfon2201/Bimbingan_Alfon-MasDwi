<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Satuan extends CI_Controller {
    

        function __construct(){
            parent ::__construct();
            
            $this->load->model('satuan_m');
            $this->load->library('form_validation');
        }
        public function index()
        {
            $this->load->model('satuan_m');
		    $data['row'] =$this->satuan_m->get();
            $this->load->view('template/template_header');
            $this->load->view('satuan/view_satuan',$data);
            $this->load->view('template/template_footer');
        }
        // public function add()
        // {
        //     $this->load->view('template/template_header');
        //     $this->load->view('satuan/form_add_satuan');
        //     $this->load->view('template/template_footer');
        // }

        public function tambah()
	{	
		$this->load->model('satuan_m');
		$data['row'] =$this->satuan_m->get();
        //print_r($_POST['level']);
		$this->load->library('form_validation');
        $this->form_validation->set_rules('nama_satuan','Nama Satuan','required');
		
		$this->form_validation->set_message('required', '%s Masih kosong silakan isi');
		
		
		//belum ke baca
		$this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');
        if($this->form_validation->run() == FALSE)
        {
            
            $this->load->view('template/template_header');
            $this->load->view('satuan/satuan_form_add');
            $this->load->view('template/template_footer');
        }else 
            {
                $post = $this->input->post(null, TRUE);
                $this->satuan_m->add($post);
                    // if($this->db->affected_rows() >0)
                    // {
                    //     echo "<script> 
                    //         alert('Data Berhasil Disimpan');
                    //     </script";
                    // }
               
                    // echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                    echo "<script>window.location='" .site_url('satuan'). "';</script>"; 
                    
            }
        }

        public function edit($id)
        {	
            // $this->load->model('user_m');
            // $data['row'] =$this->user_m->get();
            //print_r($_POST['level']);
            
            $this->form_validation->set_rules('nama_satuan','Nama Lengkap','required');
           
            
            //belum ke baca
            $this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');
            if($this->form_validation->run() == FALSE)
            {
                $query =$this->satuan_m->get($id);
                if($query->num_rows()>0){
                    $data['row']=$query->row();
                    $this->load->view('template/template_header');
                    $this->load->view('satuan/satuan_form_edit',$data);
                    $this->load->view('template/template_footer');
                }else{
                    echo "<script> alert('Data Tidak Ditemukan');"; 
                    echo "window.location='" .site_url('user_c'). "';</script>"; 
                }
                
            }else 
                {
                    $post = $this->input->post(null, TRUE);
                    $this->satuan_m->edit($post);
                        // if($this->db->affected_rows() >0)
                        // {
                        //     echo "<script> 
                        //         alert('Data Berhasil Disimpan');
                        //     </script";
                        // }
                   
                        // echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                        echo "<script>window.location='" .site_url('satuan'). "';</script>"; 
                        
                }
        }

        public function del()
            {	
                $id = $this->input->post('id_satuan');
                $data['row'] =$this->satuan_m->get();
                
                $this->satuan_m->del($id);
                // if($this->db->affected_rows() >0)
                // {
                   
                // }
                // echo "<script> 
                //         alert('Data Berhasil Dihapus');
                //     </script";
                echo "<script>window.location='" .site_url('satuan'). "';</script>"; 
                
            }

    }
    
    /* End of file Satuan.php */
    