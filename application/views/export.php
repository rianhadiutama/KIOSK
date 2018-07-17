<table border="1" cellpadding="8" width="100%">
    <tr>  
    <th>No. Nilai</th>  
    <th>Kode Mata Kuliah</th>
    <th>Nama Mata Kuliah</th>
    <th>NIM</th>  
    <th>Nama</th>
    <th>Tugas 1</th>
    <th>Tugas 2</th>
    <th>Tugas 3</th>
    <th>Tugas 4</th>
    <th>Tugas 5</th>
    <th>Presensi</th>
    <th>UTS</th>
    <th>UAS</th>
    <th>Praktikum</th>
    <th>Nilai</th>          
    <th>Grade</th>
    </tr>
    <?php
    if( ! empty($data_nilai)){ 
        echo "<tr>";
        // Jika data pada database tidak sama dengan empty (alias ada datanya)  
        foreach($data_nilai as $dn){ 
            // Lakukan looping pada variabel siswa dari controller  
            echo "<tr>";    
            echo "<td>".$dn->ID_NILAI."</td>";    
            echo "<td>".$dn->KODE_MK."</td>"; 
            echo "<td>".$dn->NAMA_MATA_KULIAH."</td>";    
            echo "<td>".$dn->NIM."</td>";    
            echo "<td>".$dn->NAMA."</td>";
            echo "<td>".$dn->TUGAS_1."</td>";    
            echo "<td>".$dn->TUGAS_2."</td>";    
            echo "<td>".$dn->TUGAS_3."</td>";    
            echo "<td>".$dn->TUGAS_4."</td>";
            echo "<td>".$dn->TUGAS_5."</td>";
            echo "<td>".$dn->PRESENSI."</td>";
            echo "<td>".$dn->UTS."</td>";
            echo "<td>".$dn->UAS."</td>";
            echo "<td>".$dn->PRAKTIKUM."</td>";
            echo "<td>".$dn->NILAI."</td>";
            echo "<td>".$dn->GRADE."</td>";    
            echo "</tr>";  
        }
    }else{ // Jika data tidak ada  
        echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
    }?>
</table>
