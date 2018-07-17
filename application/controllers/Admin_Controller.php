<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->model('Database_Nilai');
        $this->load->model('excel_import_model');
        $this->load->library('excel');
    }
    
	function adminMode()
	{
		$this->load->view('admin_view');
    }
    
    function fetch(){
  $data = $this->excel_import_model->select();
  $output = '
  <table class="table table-striped table-bordered">
   <tr>
    <th>ID</th>
    <th>KODE MATA KULIAH</th>
    <th>NIM</th>
    <th>NAMA</th>
    <th>TUGAS 1</th>
    <th>TUGAS 2</th>
    <th>TUGAS 3</th>
    <th>TUGAS 4</th>
    <th>TUGAS 5</th>
    <th>PRESENSI</th>
    <th>UTS</th>
    <th>UAS</th>
    <th>PRAKTIKUM</th>
    <th>NILAI</th>
    <th>GRADE</th>

   </tr>
  ';
  foreach($data->result() as $row)
  {
   $output .= '
   <tr>
    <td>'.$row->ID_NILAI.'</td>
    <td>'.$row->KODE_MK.'</td>
    <td>'.$row->NIM.'</td>
    <td>'.$row->NAMA.'</td>
    <td>'.$row->TUGAS_1.'</td>
    <td>'.$row->TUGAS_2.'</td>
    <td>'.$row->TUGAS_3.'</td>
    <td>'.$row->TUGAS_4.'</td>
    <td>'.$row->TUGAS_5.'</td>
    <td>'.$row->PRESENSI.'</td>
    <td>'.$row->UTS.'</td>
    <td>'.$row->UAS.'</td>
    <td>'.$row->PRAKTIKUM.'</td>
    <td>'.$row->NILAI.'</td>
    <td>'.$row->GRADE.'</td>
   </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }
    function import(){
  if(isset($_FILES["file"]["name"]))
  {
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $kode_mk = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $nama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
     $tugas1 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
     $tugas2 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
     $tugas3 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
     $tugas4 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
     $tugas5 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
     $presensi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
     $uts = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
     $uas = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
     $praktikum = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
     $nilai = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
     $grade = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
     $data[] = array(
         //FORMAT SINTAKS
         //'NAMA ATTRIBUT' => $NAMA_VARIABEL
      'ID_NILAI'  => $id,
      'KODE_MK'   => $kode_mk,
      'NIM'    => $nim,
      'NAMA'  => $nama,
      'TUGAS_1'   => $tugas1,
      'TUGAS_2'  => $tugas2,
      'TUGAS_3'   => $tugas3,
      'TUGAS_4'    => $tugas4,
      'TUGAS_5'  => $tugas5,
      'PRESENSI'   => $presensi,
      'UTS'  => $uts,
      'UAS'   => $uas,
      'PRAKTIKUM'    => $praktikum,
      'NILAI'  => $nilai,
      'GRADE'   => $grade
     );
    }
   }
   $this->excel_import_model->insert($data);
   echo 'Data Imported successfully';
  } 
 }
}
?>