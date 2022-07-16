<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends CI_Model{
    
    public function get($id = null)
    {
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan =tb_barang.id_satuan');
        if($id != null){
            $this->db-> where('kode_barang', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        
        $params ['kode_barang'] = $post['kode'];
        $params ['id_satuan'] = $post['satuan'];
        $params ['nama_barang'] = $post['barang'];
        $params ['stok'] = $post['stok'];
        $params ['harga_beli'] = $post['beli'];
        $params ['harga_jual'] = $post['jual'];
        $this->db->insert('tb_barang',$params);

    }

    public function edit($post){
        
        $params ['kode_barang'] = $post['kode'];
        $params ['id_satuan'] = $post['satuan'];
        $params ['nama_barang'] = $post['barang'];
        $params ['stok'] = $post['stok'];
        $params ['harga_beli'] = $post['beli'];
        $params ['harga_jual'] = $post['jual'];
        $this->db->where('kode_barang',$post['kode_barang']);
        $this->db->update('tb_barang',$params);

    }
    public function del($id){
        
        $this->db->where('kode_barang',$id);
        $this->db->delete('tb_barang');

    }



    // edit barang
    public function editStok( $data, $where ) {

        $this->db->where( $where )->update('tb_barang', $data);
    }
    
    
}