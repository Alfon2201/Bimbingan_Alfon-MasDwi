<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct(){
		parent ::__construct();
		check_not_login();
		$this->load->model('login_model');
	}
	 public function index()
	{	
		$this->load->model('login_model');
		$data['row'] =$this->login_model->get();
		
		$this->load->view('template/template_header');

		// Main content
		$this->load->view('user/view_user', $data);

		$this->load->view('template/template_footer');
	}

	//tambah data user
	public function add()
	{	
		//check_not_login();

		//$this->load->model('login_model');
	//	$data['row'] =$this->login_model->get();
	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('fullname','Nama Lengkap','required');
	// //	$this->form_validation->set_rules('username','username','required|min_length[5] |is_unique[tb_users.username');
	// 	$this->form_validation->set_rules('username','username','required|min_length[5] ');
	// 	$this->form_validation->set_rules('password','Password ','required|min_length[8]');
	// 	$this->form_validation->set_rules('passconf','Konfirmasi Password','required|matches[password]',
	// 		array('matches' =>'%s tidak sesuai password')
	// 	);
	// 	$this->form_validation->set_rules('lavel','jabatan','required');
	// 	$this->form_validation->set_rules('no','No Telepon','required|min_length[11]');
		
	// 	$this->form_validation->set_message('required', '%s Masih kosong silakan isi');
	// 	$this->form_validation->set_message('min_length', '%s Jumlah karakter tidak sesuai');
		
	// 	//belum ke baca
	// 	$this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');


	// 	if($this->form_validation->run()== FALSE)
	// 	{
	// 		$this->load->view('template/template_header');
	// 		$this->load->view('user/user_form_add');
	// 		$this->load->view('template/template_footer');
	// 	}else {
	// 		$post = $this->input->post(null, TRUE);
	// 		$this->login_model->add($post);
	// 		if($this->db->affected_rows() >0){
	// 			echo "<script> 
	// 				alert('Data Berhasil Disimpan')
	// 			</script";
	// 		}else{
	// 			echo "<script> 
	// 			window.location='".site_url('dashboard')."'
	// 		</script>";
	// 		}
	// 	}
	
	// }
	
	}	

		
}
