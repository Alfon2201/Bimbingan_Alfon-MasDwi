<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penjualan  extends CI_Controller {


        public function __construct() {

            parent::__construct();

            // load model
            $this->load->model('Penjualan_model');
            $this->load->model('Barang_m');

            $this->load->library('cart');
        }
    
        public function index(){
            $this->load->model('penjualan_m');
		    $data['penjualan'] =$this->Penjualan_model->ambil_penjualan();
            
            $this->load->view('template/template_header');
            
            $this->load->view('penjualan/view_penjualan',$data);
            $this->load->view('template/template_footer');
        }

        public function tampil($id){
            
            $this->load->model('penjualan_m');
            $this->load->model('barang_m');
		    $data['row'] =$this->penjualan_m->get();
            $data['row_barang'] =$this->barang_m->get();
           
            $query =$this->penjualan_m->get($id);
            if($query->num_rows()>0){
                $data['row']=$query->row();
                $this->load->view('template/template_header');
                $this->load->view('penjualan/tampil_transaksi',$data);
                $this->load->view('template/template_footer');
            }else{
                echo "<script> alert('Data Tidak Ditemukan');"; 
                echo "window.location='" .site_url('user_c'). "';</script>"; 
            }
            
            
        }




        // hapus data
        public function hapus( $kd_order ){

            $this->Penjualan_model->aksi_hapus( $kd_order );
            redirect('penjualan/index');
        }



        public function tambah() {

            

            // ambil data user berdasarkan id_user 
            $data['user'] = $this->Penjualan_model->ambil_data_user_byid();


            $this->load->view('template/template_header');
            $this->load->view('penjualan/view_penjualan_tambah', $data);
            $this->load->view('template/template_footer');
        }



        public function tambah_detail() {


            // input
            $kd_order = $this->input->get('kd_order');
            $tanggal = $this->input->get('tgl');


            

            // ambil data user berdasarkan id_user 
            $data['user'] = $this->Penjualan_model->ambil_data_user_byid();
            $data['kd_order'] = $kd_order;
            $data['tanggal'] = $tanggal;
            $data['barang']  = $this->Barang_m->get();


            $this->load->view('template/template_header');
            $this->load->view('penjualan/view_penjualan_tambahdetail', $data);
            $this->load->view('template/template_footer');
        }




        public function add_cart() {


            // input hidden
            $kode_order = $this->input->post('kd_order');
            $tanggal = $this->input->post('tgl');


            $pilih_barang = $this->input->post('kode_barang');
            $jumlah = $this->input->post('jumlah');
            $explode = explode('-', $pilih_barang);

            $kode_barang = $explode[0];
            $nama_barang = $explode[1];


            $barang = $this->Barang_m->get( $kode_barang )->row_array();
            $harga = $barang['harga_jual'];
            
            
            $data = array(
                'id'      => $kode_barang,
                'qty'     => $jumlah,
                'price'   => intval($harga),
                'name'    => $this->clean($nama_barang),
                'coupon' => ""
            );        
            
            $this->cart->insert($data);
            redirect('penjualan/tambah_detail?kd_order='. $kode_order.'&tgl='.$tanggal);
        }



        public function tampil_cart() {

            $cart = $this->cart->contents();
            print_r( $cart );
        }


        public function remove( $rowid ) {

            // input hidden
            $kode_order = $this->input->get('kd_order');
            $tanggal = $this->input->get('tgl');


            $data = array(
                'rowid' => $rowid,
                'qty'   => 0
            );
            
            $this->cart->update($data);

            redirect('penjualan/tambah_detail?kd_order='. $kode_order.'&tgl='.$tanggal);
        }









        // simpan penjualan 
        public function simpan_penjualan() {

            $kode_order = $this->input->post('kd_order');
            $tanggal = $this->input->post('tanggal');

            $id_user = $this->session->userdata('id_user');

            $tb_penjualan_info = array(

                'kd_order'  => $kode_order,
                'id_user'   => $id_user,
                'tanggal'   => $tanggal
            );


            $this->Penjualan_model->insert_data_penjualan_info( $tb_penjualan_info );


            // informasi detail penjualan
            $tb_penjualan_detail = array();

            $cart = $this->cart->contents();
            foreach ( $cart AS $ct ) {

                array_push( $tb_penjualan_detail, array(

                    'kd_order'      => $kode_order,
                    'kode_barang'   => $ct['id'],
                    'permintaan'    => $ct['qty']
                ) );
            }

            // insert batch
            $this->Penjualan_model->insert_data_penjualan_detail( $tb_penjualan_detail );



            // session cart destroy
            $this->cart->destroy();

            redirect('penjualan/index');
        }







        function clean($string) {
            $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
         
            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
         }






         public function laporan_penjualan_t() {

            $dt_penjualan =$this->Penjualan_model->ambil_penjualan_list_detail();
            
            foreach ( $dt_penjualan AS $isi ) {

                echo $isi['kode_barang'].' '.$isi['nama_barang'].' : '.$isi['permintaan'].'<br>';
            }
         }


         public function laporan_penjualan(){

            // create new PDF document
            $pdf = new Pdf_tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('LAPORAN PENJUALAN-'. date('Ymd'));
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    
            // remove default header/footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
    
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
    
            // ---------------------------------------------------------
    
            // add a page
            $pdf->AddPage('L');
    
    
            // set text shadow effect
            $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    
            
    
    
    
    
    
    
    
    
            /** Header */
            // set font
            $pdf->SetFont('times', '', 14);
            $header = '
                <div style="text-align: center">
                    <h4 style="margin: 0px">LAPORAN PENJUALAN</h4>
                    <label>Rekapitulasi Penjualan Barang tahun '.date('Y').'</label>
                </div><br><br>';
            $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
    
    
    
    
    
    
            
            $dt_penjualan =$this->Penjualan_model->ambil_penjualan_list_detail();
    
    
            $table_body = "";
    
    
            $nomor = 1;
            $total = 0;
            foreach ( $dt_penjualan AS $row ) {
                

                $total += ($row->harga_jual * $row->permintaan);

                $table_body .= '<tr>
                    <td>'.$nomor.'</td>
                    <td>'.$row->kd_order.'</td>
                    <td>'.$row->kode_barang.'</td>
                    <td>'.$row->nama_barang.'</td>
                    <td>'.$row->permintaan.'</td>
                    <td>'.number_format($row->harga_jual, 2).'</td>
                    <td>'.number_format($row->harga_jual * $row->permintaan, 2).'</td>
                    <td>'.date('d-m-Y H.i A', strtotime($row->tgl_penjualan)).'</td>
                </tr>';
    
    
                $nomor++;
            }
    
            $pdf->SetFont('times', '', 11);
            $html = '<table border="1" width="100%" cellpadding="6">
                <tr>
                    <td width="5%"><b>No</b></td>
                    <td width="15%"><b>Kode Order</b></td>
                    <td width="10%"><b>Kode Barang</b></td>
                    <td width="25%"><b>Nama Barang</b></td>
                    <td width="7%"><b>Jumlah</b></td>
                    <td width="10%"><b>Harga Jual</b></td>
                    <td width="10%"><b>Total</b></td>
                    <td width="15%"><b>Tanggal</b></td>
                </tr>
    
    
                '.$table_body.'
                <tr>
                    <td colspan="6" align="right"><b>TOTAL</b></td>
                    <td colspan="2">'.number_format($total).'</td>
                </tr>
            </table>';
    
    
            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
            // ---------------------------------------------------------
    
            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdf->Output('example_001.pdf', 'I');
    
            //============================================================+
            // END OF FILE
            //============================================================+
        }


        
    }