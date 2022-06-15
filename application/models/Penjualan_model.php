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
    }
    
    /* End of file Penjualan_model.php */
    