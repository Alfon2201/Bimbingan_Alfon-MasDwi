<?php 


    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penjualan_model extends CI_Model {
    
        
        public function timeframe_penjualan( $start, $end, $kode_barang ) {

            $sql = "SELECT kode_barang, YEAR(tanggal), MONTHNAME(tanggal) as bulan , DATE(tanggal) AS tgl,
                    SUM(permintaan) AS penjualan 
                    
                    FROM `tb_penjualan_info` 
                    
                    LEFT JOIN tb_penjualan_detail ON tb_penjualan_detail.kd_order = tb_penjualan_info.kd_order 
                    WHERE kode_barang = '$kode_barang' AND 
                    DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$start' AND '$end' 
                    
                    GROUP BY MONTHNAME(tanggal)";

            return $this->db->query( $sql );
        }



        public function ambil_penjualan() {

            $this->db->select('tb_users.nama, tb_penjualan_info.*')->from('tb_penjualan_info');
            $this->db->join('tb_users', 'tb_users.id_user = tb_penjualan_info.id_user');
            $this->db->order_by('tanggal', 'DESC');

            return $this->db->get()->result_array();
        }



        public function ambil_penjualan_list_detail() {

            $this->db->select('tb_penjualan_detail.*, tb_penjualan_info.*, tb_barang.nama_barang')->from('tb_penjualan_detail');
            $this->db->join('tb_penjualan_info', 'tb_penjualan_info.kd_order = tb_penjualan_detail.kd_order');
            $this->db->join('tb_barang', 'tb_penjualan_detail.kode_barang = tb_barang.kode_barang');
            $this->db->order_by('tb_penjualan_info.tanggal', 'DESC');

            return $this->db->get()->result();
        }








        public function aksi_hapus( $kd_order ) {

            // hapus detail 
            $this->db->where('kd_order', $kd_order)->delete('tb_penjualan_detail');

            // hapus info
            $this->db->where('kd_order', $kd_order)->delete('tb_penjualan_info');
        }



        public function ambil_data_user_byid() {

            $id_user = $this->session->userdata('id_user');
            return $this->db->get_where('tb_users', ['id_user' => $id_user])->row_array();
        }




        public function insert_data_penjualan_info( $data ){ 

            $this->db->insert('tb_penjualan_info', $data);
            return $this->db->insert_id();
        }


        public function insert_data_penjualan_detail( $tb_penjualan_detail ) {

            $this->db->insert_batch( 'tb_penjualan_detail', $tb_penjualan_detail );
        }
    }
    
    /* End of file Penjualan_model.php */
    