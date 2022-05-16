<?php define('BASEPATH') OR exit('no direct script access allowed');

class Login extends CI_Model{

    public function login()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->whare('username', $post['username']);
        $this->db->whare('password', sha1($post['password']));
        $query-> $this->db->get();
        return $query;
    }

} 