<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model{


    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('tb_users');
        if($id != null){
            $this->db-> where('id_user', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post){
        
        $params ['nama'] = $post['fullname'];
        $params ['username'] = $post['username'];
        $params ['password'] = sha1($post['password']);
        $params ['level'] = $post['level'];
        $params ['alamat'] = $post['address'] !=""? $post['address']:null ;
        $params ['no_telp'] = $post['no'];
        $this->db->insert('tb_users',$params);

    }

    public function edit($post){
        
        $params ['nama'] = $post['fullname'];
        $params ['username'] = $post['username'];
        if(!empty($post['password'])){
            $params ['password'] = sha1($post['password']);
        }
        
        $params ['level'] = $post['level'];
        $params ['alamat'] = $post['address'] !=""? $post['address']:null ;
        $params ['no_telp'] = $post['no'];
        $this->db->where('id_user',$post['id_user']);
        $this->db->update('tb_users',$params);

    }

    public function del($id){
        
        $this->db->where('id_user',$id);
        $this->db->delete('tb_users');

    }
}