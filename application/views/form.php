<html>
<head>
  <title>Form Import</title>
  
  <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>
</head>
<body>
  <h3>Form Import</h3>
  <hr>
  
  <br>
  <br>
  
  <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
  <form method="post" action="<?php echo base_url("index.php/Admin_NilaiController2/form"); ?>" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <input type="file" name="file">
    
    <!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <input type="submit" name="preview" value="Preview">
  </form>
  
  
  <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("index.php/Admin_NilaiController2/import")."'>";
    
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
    </div>";
    
    echo "<table border='1' cellpadding='8'>
    <tr>
      <th colspan='5'>Preview Data</th>
    </tr>
    <tr>
      <th>NO</th>
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
    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $ID_NILAI = $row['A']; // Ambil data 
      $KODE_MK = $row['B']; 
      $NIM = $row['C']; 
      $NAMA = $row['D'];
      $TUGAS_1 = $row['E'];
      $TUGAS_2 = $row['F'];
      $TUGAS_3 = $row['G'];
      $TUGAS_4 = $row['H'];
      $TUGAS_5 = $row['I'];
      $PRESENSI = $row['J'];
      $UTS = $row['K'];
      $UAS = $row['L'];
      $PRAKTIKUM = $row['M'];
      $NILAI = $row['N'];
      $GRADE = $row['O'];

      
      // Cek jika semua data tidak diisi
      if(empty($ID_NILAI) && empty($KODE_MK) && empty($NIM) && empty($NAMA) && empty($TUGAS_1) && empty($TUGAS_2) &&  empty($TUGAS_3) &&  empty($TUGAS_4) && empty($TUGAS_5) &&  empty($PRESENSI) &&  empty($UTS) &&  empty($UAS) && empty($PRAKTIKUM) &&  empty($NILAI) &&  empty($GRADE)){
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        }
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $ID_NILAI_td = ( ! empty($ID_NILAI))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $KODE_MK_td = ( ! empty($KODE_MK))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $NIM_td = ( ! empty($NIM))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $NAMA_td = ( ! empty($NAMA))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
        $TUGAS_1_td = ( ! empty($TUGAS_1))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $TUGAS_2_td = ( ! empty($TUGAS_2))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $TUGAS_3_td = ( ! empty($TUGAS_3))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $TUGAS_4_td = ( ! empty($TUGAS_4))? "" : " style='background: #E07171;'";
        $TUGAS_5_td = ( ! empty($TUGAS_5))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $PRESENSI_td = ( ! empty($PRESENSI))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $UTS_td = ( ! empty($UTS))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $UAS_td = ( ! empty($UAS))? "" : " style='background: #E07171;'";
        $PRAKTIKUM_td = ( ! empty($PRAKTIKUM))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $NILAI_td = ( ! empty($NILAI))? "" : " style='background: #E07171;'";
        $GRADE_td = ( ! empty($GRADE))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        
        // Jika salah satu data ada yang kosong
        if(
            empty($ID_NILAI) or 
            empty($KODE_MK) or 
            empty($NIM) or 
            empty($NAMA) or
            empty($TUGAS_1) or 
            empty($TUGAS_2) or 
            empty($TUGAS_3) or 
            empty($TUGAS_4) or
            empty($TUGAS_5) or 
            empty($PRESENSI) or 
            empty($UTS) or 
            empty($UAS) or
            empty($PRAKTIKUM) or 
            empty($NILAI) or 
            empty($GRADE)
            ){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$ID_NILAI_td.">".$ID_NILAI."</td>";
        echo "<td".$KODE_MK_td.">".$KODE_MK."</td>";
        echo "<td".$NIM_td.">".$NIM."</td>";
        echo "<td".$NAMA_td.">".$NILAI."</td>";
        echo "<td".$TUGAS_1_td.">".$TUGAS_1."</td>";
        echo "<td".$TUGAS_2_td.">".$TUGAS_2."</td>";
        echo "<td".$TUGAS_3_td.">".$TUGAS_3."</td>";
        echo "<td".$TUGAS_4_td.">".$TUGAS_4."</td>";
        echo "<td".$TUGAS_5_td.">".$TUGAS_5."</td>";
        echo "<td".$PRESENSI_td.">".$PRESENSI."</td>";
        echo "<td".$UTS_td.">".$UTS."</td>";
        echo "<td".$UAS_td.">".$UAS."</td>";
        echo "<td".$PRAKTIKUM_td.">".$PRAKTIKUM."</td>";
        echo "<td".$NILAI_td.">".$NILAI."</td>";
        echo "<td".$GRADE_td.">".$GRADE."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 1
    // Jika lebih dari 1, berarti ada data yang masih kosong
    if($kosong > 1){
    ?>	
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button type='submit' name='import'>Import</button>";
      echo "<a href='".base_url("index.php/Admin_NilaiController2/form")."'>Cancel</a>";
    }
    
    echo "</form>";
  }
  ?>
</body>
</html>