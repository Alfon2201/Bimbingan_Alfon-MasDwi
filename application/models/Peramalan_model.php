<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Peramalan_model extends CI_Model {
    
        public function ambil_data() {

            return $this->db->get('tb_peramalan');
        }
        
        
        public function ambil_data_berdasarkan_id( $id_peramalan ) {

            $this->db->where('id_peramalan', $id_peramalan);
            return $this->db->get('tb_peramalan');
        }


        public function insert( $data ) {

            $this->db->insert('tb_peramalan', $data);

            return $this->db->insert_id();
        }

        public function hapus( $id_peramalan ) {

            $this->db->where('id_peramalan', $id_peramalan)->delete('tb_peramalan');
        }



        // pencarian barang berdasarkan penjualan dan tanggal
        public function pencarianBarang() {

            $start = $this->input->get('start');
            $end = $this->input->get('end');

            $start = date('Y-m-d', strtotime( $start ));
            $end = date('Y-m-d', strtotime( $end ));

            $sql = "SELECT tb_penjualan_info.tanggal, tb_penjualan_detail.permintaan, tb_barang.nama_barang, tb_barang.kode_barang

                    FROM tb_penjualan_detail
                    JOIN tb_penjualan_info ON tb_penjualan_info.kd_order = tb_penjualan_detail.kd_order 
                    JOIN tb_barang ON tb_barang.kode_barang = tb_penjualan_detail.kode_barang
                    
                    WHERE DATE_FORMAT(tb_penjualan_info.tanggal, '%Y-%m-%d') >= '$start'
                    AND DATE_FORMAT(tb_penjualan_info.tanggal, '%Y-%m-%d') <= '$end'
                    
                    GROUP BY tb_barang.kode_barang ORDER BY SUM(permintaan) DESC";

            return $this->db->query( $sql )->result_array();
        }

    }
    
    /* End of file Peramalan_model.php */
    