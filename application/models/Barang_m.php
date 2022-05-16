<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends CI_Model{

    public function get($id = null)
    {
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan =tb_barang.id_satuan');
        if($id != null){
            $this->db-> whare('kode_barang');
        }
        $query = $this->db->get();
        return $query;
    }
    public function tampil_Alljoin(){
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan =tb_barang.id_satuan');
        $query = $this->db->get();
        return $query->result_array();
      }
    
}