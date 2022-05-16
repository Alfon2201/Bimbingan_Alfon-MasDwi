<?php

class Fungsi{

    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('login_model');
        $id_user = $this->ci->session->userdata('id_user');
        $user_data = $this->ci->login_model->get($id_user)->row();
        return $user_data;
    }
} 