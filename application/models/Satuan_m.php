<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_m extends CI_Model{
    
    public function get($id = null)
    {
        $this->db->from('tb_satuan');
        if($id != null){
            $this->db-> where('id_satuan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post){
        
        $params ['nama_satuan'] = $post['nama_satuan'];
        
        $this->db->insert('tb_satuan',$params);

    }
    public function edit($post){
        
        $params ['nama_satuan'] = $post['nama_satuan'];
        
        $this->db->where('id_satuan',$post['id_satuan']);
        $this->db->update('tb_satuan',$params);

    }

    public function del($id){
        
        $this->db->where('id_satuan',$id);
        $this->db->delete('tb_satuan');

    }
}
