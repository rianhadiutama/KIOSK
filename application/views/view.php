<html>
<head>
  <title>IMPORT EXCEL CI 3</title>
</head>
<body>
  <h1>Data Siswa</h1><hr>
  <a href="<?php echo base_url("index.php/Admin_NilaiController2/form"); ?>">Import Data</a><br><br>

  <table border="1" cellpadding="8">
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
  </tr>

  <?php
  if( ! empty($datanilai)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
    foreach($datanilai as $data){ // Lakukan looping pada variabel siswa dari controller
      echo "<tr>";
      echo "<td>".$data->ID_NILAI."</td>";
      echo "<td>".$data->KODE_MK."</td>";
      echo "<td>".$data->NIM."</td>";
      echo "<td>".$data->NAMA."</td>";
      echo "<td>".$data->TUGAS_1."</td>";
      echo "<td>".$data->TUGAS_2."</td>";
      echo "<td>".$data->TUGAS_3."</td>";
      echo "<td>".$data->TUGAS_4."</td>";
      echo "<td>".$data->TUGAS_5."</td>";
      echo "<td>".$data->PRESENSI."</td>";
      echo "<td>".$data->UTS."</td>";
      echo "<td>".$data->UAS."</td>";
      echo "<td>".$data->PRAKTIKUM."</td>";
      echo "<td>".$data->NILAI."</td>";
      echo "<td>".$data->GRADE."</td>";
      echo "</tr>";
    }
  }else{ // Jika data tidak ada
    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
  }
  ?>
  </table>
  
</body>
</html>