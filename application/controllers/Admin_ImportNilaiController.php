<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin_ImportNilaiController extends CI_Controller {
    private $fileName = 'import_data';
    function __construct(){
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    public function nilai_view()
    {
        $this->load->view('admin_nilai');
    }
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './assets/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "ID_NILAI"=> $rowData[0][0],
                    "KODE_MK"=> $rowData[0][1],
                    "NIM"=> $rowData[0][2],
                    "NAMA"=> $rowData[0][3],
                    "TUGAS_1"=> $rowData[0][4],
                    "TUGAS_2"=> $rowData[0][5],
                    "TUGAS_3"=> $rowData[0][6],
                    "TUGAS_4"=> $rowData[0][7],
                    "TUGAS_5"=> $rowData[0][8],
                    "PRESENSI"=> $rowData[0][9],
                    "UTS"=> $rowData[0][10],
                    "UAS"=> $rowData[0][11],
                    "PRAKTIKUM"=> $rowData[0][12],
                    "NILAI"=> $rowData[0][13],
                    "GRADE"=> $rowData[0][14],
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("nilai",$data);
                delete_files($media['file_path']);
                     
            }
        redirect('Admin_NilaiController/nilai_view');
    }
}