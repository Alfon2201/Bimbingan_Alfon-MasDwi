<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_c extends CI_Controller {

    function __construct(){
		parent ::__construct();
		check_not_login();
		$this->load->model('user_m');
        $this->load->library('form_validation');
	}

    public function index()
	{	
		$this->load->model('user_m');
		$data['row'] =$this->user_m->get();
		
		$this->load->view('template/template_header');

		// Main content
		$this->load->view('user/user_data',$data);

		$this->load->view('template/template_footer');
	}

    public function tambah()
	{	
		$this->load->model('user_m');
		$data['row'] =$this->user_m->get();
        //print_r($_POST['level']);
		$this->load->library('form_validation');
        $this->form_validation->set_rules('fullname','Nama Lengkap','required');
		$this->form_validation->set_rules('username','username','required|min_length[5] |is_unique[tb_users.username]');
		
		$this->form_validation->set_rules('password','Password ','required|min_length[8]');
		$this->form_validation->set_rules('passconf','Konfirmasi Password','required|matches[password]',
			array('matches' =>'%s tidak sesuai password') );
		$this->form_validation->set_rules('level','jabatan','required');
		$this->form_validation->set_rules('no','No Telepon','required|min_length[11]');
		$this->form_validation->set_message('required', '%s Masih kosong silakan isi');
		$this->form_validation->set_message('min_length', '%s Jumlah karakter tidak sesuai');
		
		//belum ke baca
		$this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');
        if($this->form_validation->run() == FALSE)
        {
            
            $this->load->view('template/template_header');
            $this->load->view('user/user_form_add1');
            $this->load->view('template/template_footer');
        }else 
            {
                $post = $this->input->post(null, TRUE);
                $this->user_m->add($post);
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
		// $this->load->model('user_m');
		// $data['row'] =$this->user_m->get();
        //print_r($_POST['level']);
		
        $this->form_validation->set_rules('fullname','Nama Lengkap','required');
		$this->form_validation->set_rules('username','username','required|min_length[5] |callback_username_check');
		if($this->input->post('password')){
            $this->form_validation->set_rules('password','Password ','|min_length[8]');
            
            $this->form_validation->set_rules('passconf','Konfirmasi Password','|matches[password]',
                array('matches' =>'%s tidak sesuai password') );
            }
        if($this->input->post('passconf')){               
            $this->form_validation->set_rules('passconf','Konfirmasi Password','|matches[password]',
                array('matches' =>'%s tidak sesuai password') );
            }
		$this->form_validation->set_rules('level','jabatan','required');
		$this->form_validation->set_rules('no','No Telepon','required|min_length[11]');
		$this->form_validation->set_message('required', '%s Masih kosong silakan isi');
		$this->form_validation->set_message('min_length', '%s Jumlah karakter tidak sesuai');
		
		//belum ke baca
		$this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');
        if($this->form_validation->run() == FALSE)
        {
            $query =$this->user_m->get($id);
            if($query->num_rows()>0){
                $data['row']=$query->row();
                $this->load->view('template/template_header');
                $this->load->view('user/user_form_edit',$data);
                $this->load->view('template/template_footer');
            }else{
                echo "<script> alert('Data Tidak Ditemukan');"; 
                echo "window.location='" .site_url('user_c'). "';</script>"; 
            }
            
        }else 
            {
                $post = $this->input->post(null, TRUE);
                $this->user_m->edit($post);
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
    function username_check(){
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_users WHERE username = '$post[username]'AND id_user != '$post[id_user]'");
        if(($query->num_rows()>0)){
            $this->form_validation->set_message('username_check', '%s ini sudah dipakai, silakan ganti ');
            return FALSE;
        }else{
            return TRUE;
        }
    }
            public function del()
            {	
                $id = $this->input->post('id_user');
                $data['row'] =$this->user_m->get();
                
                $this->user_m->del($id);
                // if($this->db->affected_rows() >0)
                // {
                   
                // }
                // echo "<script> 
                //         alert('Data Berhasil Dihapus');
                //     </script";
                echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                
            }

                      
               
}
		

