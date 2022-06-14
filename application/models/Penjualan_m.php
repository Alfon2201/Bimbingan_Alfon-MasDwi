<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_m extends CI_Model{

    public function get($id = null)
    {
        $this->db->from('tb_penjualan_info');
        $this->db->join('tb_penjualan_detail', 'tb_penjualan_detail.kd_order = tb_penjualan_info.kd_order');
        
        if($id != null){
            $this->db-> where('kd_order', $id);
        }
        $query = $this->db->get();
        return $query;
    }


}