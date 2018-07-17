<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataNilai_Controller extends CI_Controller {

    function __construct()
	{
        parent::__construct();
		$this->load->model('Database_Nilai');
    }
    
	function adminMode()
	{
        $data['data_nilai']=$this->Database_Nilai->ambil_data();
		$this->load->view('admin_view',$data);
	}
	public function export(){    
		// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel    
		header("Content-type: application/vnd-ms-excel");    
		header("Content-Disposition: attachment; filename=Data_Nilai_Mata_Kuliah.xls");        
		$data['data_nilai'] = $this->Database_Nilai->ambil_data();    
		$this->load->view('export', $data);  
	}
	public function exportToExcel(){
		//LOAD PLUGIN DARI THIRD PARTY CI
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		//PANGGIL CLASS
		$excel = new PHPExcel();
		//PROPERTIES UNTUK WINDOWS 
		$excel->getProperties()->setCreator('IF Administrator')
								->setLastModifiedBy('IF Administrator')
								->setTitle("Data Nilai")
								->setSubject("Tata Usaha")
								->setDescription("Laporan Data Nilai Untuk TU atau Dosen Jika Sewaktu-waktu dibutuhkan")
								->setKeywords("Data Nilai");
		$style_column = array(
			'font' => array(
				'bold' => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPEXCEL_Style_Alignment::VERTICAL_CENTER
			),
			'borders'=> array(
				'top' =>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN
				),
				'left'=>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN
				),
				'right'=>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN
				),
				'bottom'=>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN
				)
			)
		);
		$style_row = array(
			
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders'=> array(
				'top' =>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN),
				'left'=>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN),
				'right'=>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN),
				'bottom'=>array(
					'style' =>PHPExcel_Style_Broder::BORDER_THIN)
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1',"PEMROGRAMAN OBJEK 1");
		$excel->getActiveSheet()->mergeCells('A1:C1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
	
			$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO"); 
			$excel->setActiveSheetIndex(0)->setCellValue('C3', "KODE MATA KULIAH");
			$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIM");  
			$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA");    
			$excel->setActiveSheetIndex(0)->setCellValue('F3', "TUGAS 1");
			$excel->setActiveSheetIndex(0)->setCellValue('G3', "TUGAS 2"); 
			$excel->setActiveSheetIndex(0)->setCellValue('H3', "TUGAS 3");
			$excel->setActiveSheetIndex(0)->setCellValue('I3', "TUGAS 4");  
			$excel->setActiveSheetIndex(0)->setCellValue('J3', "TUGAS 5");    
			$excel->setActiveSheetIndex(0)->setCellValue('K3', "PRESENSI");
			$excel->setActiveSheetIndex(0)->setCellValue('L3', "UTS"); 
			$excel->setActiveSheetIndex(0)->setCellValue('M3', "UAS");
			$excel->setActiveSheetIndex(0)->setCellValue('N3', "PRAKTIKUM");  
			$excel->setActiveSheetIndex(0)->setCellValue('O3', "NILAI");    
			$excel->setActiveSheetIndex(0)->setCellValue('P3', "GRADE");
	
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header    
			$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);    
			$excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
	
			$data_nilai = $this->Database_Nilai->ambil_data();
			$nomor = 1; // Untuk penomoran tabel, di awal set dengan 1    
			$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4    
			foreach($siswa as $data){ // Lakukan looping pada variabel siswa      
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $nomor);      
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data_nilai->ID_NILAI); 
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data_nilai->KODE_MK);      
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data_nilai->NIM);      
				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data_nilai->NAMA);      
				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data_nilai->TUGAS_1);
				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data_nilai->TUGAS_2);   
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data_nilai->TUGAS_3);
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data_nilai->TUGAS_4); 
				$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data_nilai->TUGAS_5);      
				$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data_nilai->PRESENSI);      
				$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data_nilai->UTS);      
				$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data_nilai->UAS);
				$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data_nilai->PRAKTIKUM);
				$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data_nilai->NILAI);   
				$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data_nilai->GRADE);               
				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)      
				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);      
				$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);              
				$no++; // Tambah 1 setiap kali looping      
				$numrow++; // Tambah 1 setiap kali looping    
			}
		// Set width kolom    
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A    
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B    
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C    
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D    
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(40); // Set width kolom F    
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(55); // Set width kolom G    
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(65); // Set width kolom H    
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(70); // Set width kolom I    
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(100); // Set width kolom J
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(120); // Set width kolom K    
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(135); // Set width kolom L    
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(145); // Set width kolom M    
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(160); // Set width kolom N    
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(180); // Set width kolom O
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(180); // Set width kolom O         
		 // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)    
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);   
		  // Set orientasi kertas jadi LANDSCAPE    
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);    
		// Set judul file excel nya    $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");    
		$excel->setActiveSheetIndex(0);    
		// Proses file excel    
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		header('Content-Disposition: attachment; filename="Data Nilai Matakuliah untuk Administrator.xlsx"'); 
		// Set nama file excel nya    
		header('Cache-Control: max-age=0');    
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2013');    
		$write->save('php://output');
	}
}
