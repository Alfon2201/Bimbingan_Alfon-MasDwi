<?php 

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Barang extends CI_Controller {
    
        public function index(){
            $this->load->model('barang_m');
		    $data['row'] =$this->barang_m->get();
            
            $this->load->view('template/template_header');
            
           // $this->load->view('barang/view_barang',$data);
            $this->load->view('template/template_footer');
        }
        
        public function tambah()
        {	
            $this->load->model('barang_m');
            $this->load->model('satuan_m');

            $data['row'] =$this->barang_m->get();
            $data['row_satuan'] =$this->satuan_m->get();

            //print_r($_POST['level']);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('kode','Kode Barang','required');
            $this->form_validation->set_rules('barang','Nama Barang','required');
            $this->form_validation->set_rules('stok','Stok Barang','required');
           
            
            $this->form_validation->set_rules('beli','Harga Beli','required');
            $this->form_validation->set_rules('jual','Harga Jual','required');
            $this->form_validation->set_message('required', '%s Masih kosong silakan isi');
            
            
            //belum ke baca
            $this->form_validation->set_message('is_unique', '{field} ini sudah di pakai ganti yang lain');
            if($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('template/template_header');
                $this->load->view('barang/barang_form_add',$data);
                $this->load->view('template/template_footer');
            }else 
                {
                    $post = $this->input->post(null, TRUE);
                    $this->barang_m->add($post);
                        // if($this->db->affected_rows() >0)
                        // {
                        //     echo "<script> 
                        //         alert('Data Berhasil Disimpan');
                        //     </script";
                        // }
                   
                        // echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                        echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                        
                }
            }            
            
    public function edit($id)
	{	
        $this->load->model('barang_m');
        $this->load->model('satuan_m');

        $data['row'] =$this->barang_m->get();
        $data['row_satuan'] =$this->satuan_m->get();
        //print_r($_POST['level']);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode','Kode Barang','required');
        $this->form_validation->set_rules('barang','Nama Barang','required');
        $this->form_validation->set_rules('stok','Stok Barang','required');
       
        
        $this->form_validation->set_rules('beli','Harga Beli','required');
        $this->form_validation->set_rules('jual','Harga Jual','required');
        $this->form_validation->set_message('required', '%s Masih kosong silakan isi');
		
		//belum ke baca
		
        if($this->form_validation->run() == FALSE)
        {
            $query =$this->barang_m->get($id);
            if($query->num_rows()>0){
                $data['row']=$query->row();
                $this->load->view('template/template_header');
                $this->load->view('barang/barang_form_edit',$data);
                $this->load->view('template/template_footer');
            }else{
                echo "<script> alert('Data Tidak Ditemukan');"; 
                echo "window.location='" .site_url('barang'). "';</script>"; 
            }
            
        }else 
            {
                $post = $this->input->post(null, TRUE);
                $this->barang_m->edit($post);
                    // if($this->db->affected_rows() >0)
                    // {
                    //     echo "<script> 
                    //         alert('Data Berhasil Disimpan');
                    //     </script";
                    // }
               
                    // echo "<script>window.location='" .site_url('user_c'). "';</script>"; 
                    echo "<script>window.location='" .site_url('barang'). "';</script>"; 
                    
            }
    }
    public function del()
    {	
        $this->load->model('barang_m');
        $id = $this->input->post('kode_barang');
        $data['row'] =$this->barang_m->get();
        
        $this->barang_m->del($id);
        // if($this->db->affected_rows() >0)
        // {
           
        // }
        // echo "<script> 
        //         alert('Data Berhasil Dihapus');
        //     </script";
        echo "<script>window.location='" .site_url('barang'). "';</script>"; 
        
    }










    public function laporan_barang(){

        // create new PDF document
        $pdf = new Pdf_tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('LAPORAN DATA BARANG-'. date('Ymd'));
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
        $pdf->AddPage();


        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        








        /** Header */
        // set font
        $pdf->SetFont('times', '', 14);
        $header = '
            <div style="text-align: center">
                <h4 style="margin: 0px">LAPORAN DATA BARANG</h4>
                <label>Berikut adalah data barang yang sudah tersimpan</label>
            </div><br><br>';
        $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);






        $this->load->model('barang_m');
		$dt_barang =$this->barang_m->get();


        $table_body = "";


        $nomor = 1;
        foreach ( $dt_barang->result() AS $row ) {

            $table_body .= '<tr>
                <td>'.$nomor.'</td>
                <td>'.$row->kode_barang.'</td>
                <td>'.$row->nama_barang.'</td>
                <td>'.$row->stok.'</td>
                <td>'.number_format($row->harga_beli, 2).'</td>
                <td>'.number_format($row->harga_jual, 2).'</td>
            </tr>';


            $nomor++;
        }

        $pdf->SetFont('times', '', 11);
        $html = '<table border="1" width="100%" cellpadding="6">
            <tr>
                <td width="5%"><b>No</b></td>
                <td width="15%"><b>Kode Barang</b></td>
                <td width="32%"><b>Nama</b></td>
                <td width="10%"><b>Stok</b></td>
                <td width="18%"><b>Harga Beli</b></td>
                <td width="18%"><b>Harga Jual</b></td>
            </tr>


            '.$table_body.'
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
    
    /* End of file Barang.php */
    