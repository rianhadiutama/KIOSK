<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_NilaiController2 extends CI_Controller {
  private $filename = "import_data"; // Kita tentukan nama filenya
  
  public function __construct(){
    parent::__construct();
    
    $this->load->model('Database_ImportNilai');
    $this->load->library('PHPExcel','PHPExcel/IOFactory');
  }
  
  public function index(){
    $data['datanilai'] = $this->Database_ImportNilai->view();
    $this->load->view('view', $data);
  }
  
  public function form(){
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di bagian Model
      $upload = $this->Database_ImportNilai->upload_file($this->filename);
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
        // Load plugin PHPExcel nya
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('form', $data);
  }
  
  public function import(){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = [];
    
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        array_push($data, [
          'ID_NILAI'=>$row['A'],
          'KODE_MK'=>$row['B'], 
          'NIM'=>$row['C'], 
          'NAMA'=>$row['D'], 
          'TUGAS_1'=>$row['E'],
          'TUGAS_2'=>$row['F'],
          'TUGAS_3'=>$row['G'], 
          'TUGAS_4'=>$row['H'], 
          'TUGAS_5'=>$row['I'], 
          'PRESENSI'=>$row['J'],
          'UTS'=>$row['K'],
          'UAS'=>$row['L'], 
          'PRAKTIKUM'=>$row['M'], 
          'NILAI'=>$row['N'], 
          'GRADE'=>$row['O'],
        ]);
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->Database_ImportNilai->insert_multiple($data);
    
    redirect("Admin_NilaiController2/index"); // Redirect ke halaman awal (ke [nama controller]  fungsi index)
  }
}