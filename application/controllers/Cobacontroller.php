<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobacontroller extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
		
    }
 
	public function nilai(){
		$this->load->view('cobacoba');
	}
	public function import_data(){
		error_reporting(0);
		$config = array(
			'upload_path' => FCPATH.'upload/',
			'allowed_types' => 'xls/xlsx'
		);
		$this->load->library('upload',$config);
		if($this->upload->do_upload('file')){
			$data = $this->upload->data();
			@chmod($data['full_path'],0777);
			$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('CP1251');
			$this->spreadsheet_excel_reader->read($data['full-path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);
			
			$data_excel = array();
			for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
				if($sheets['cells'][$i][1] == '') break;
				$data_excel[$i - 1]['ID_NILAI'] = $sheets['cells'][$i][1];
				$data_excel[$i - 1]['KODE_MK'] = $sheets['cells'][$i][2];
				$data_excel[$i - 1]['NIM'] = $sheets['cells'][$i][3];
				$data_excel[$i - 1]['NAMA'] = $sheets['cells'][$i][4];
				$data_excel[$i - 1]['TUGAS_1'] = $sheets['cells'][$i][5];
				$data_excel[$i - 1]['TUGAS_2'] = $sheets['cells'][$i][6];
				$data_excel[$i - 1]['TUGAS_3'] = $sheets['cells'][$i][7];
				$data_excel[$i - 1]['TUGAS_4'] = $sheets['cells'][$i][8];
				$data_excel[$i - 1]['TUGAS_5'] = $sheets['cells'][$i][9];
				$data_excel[$i - 1]['PRESENSI'] = $sheets['cells'][$i][10];
				$data_excel[$i - 1]['UTS'] = $sheets['cells'][$i][11];
				$data_excel[$i - 1]['UAS'] = $sheets['cells'][$i][12];
				$data_excel[$i - 1]['PRAKTIKUM'] = $sheets['cells'][$i][13];
				$data_excel[$i - 1]['NILAI'] = $sheets['cells'][$i][14];
				$data_excel[$i - 1]['GRADE'] = $sheets['cells'][$i][15];
				/*for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
					echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
				}
				echo "\n";*/

			}
			$this->db->insert_batch('nilai',$data_excel);
			redirect('Cobacontroller');
		}
	}
}