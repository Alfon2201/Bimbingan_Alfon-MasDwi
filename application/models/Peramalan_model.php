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
    }
    
    /* End of file Peramalan_model.php */
    