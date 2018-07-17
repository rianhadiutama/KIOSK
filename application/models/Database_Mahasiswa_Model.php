<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database_Mahasiswa_Model extends CI_Model{
    function ambil_data(){
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('jurusan', 'jurusan.NIM = mahasiswa.NIM');
        $this->db->join('peminatan', 'peminatan.NIM = mahasiswa.NIM');
        $query = $this->db->get();
        return $query->result();
    }
   
    function insert($data)
    {
     $this->db->insert_batch('mahasiswa', $data);
    }
}

?>