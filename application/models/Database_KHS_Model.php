<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database_KHS_Model extends CI_Model{
    function select()
    {
        $this->db->select('*');
        $this->db->from('nilai');
        $this->db->join('mata_kuliah', 'mata_kuliah.KODE_MATA_KULIAH = nilai.KODE_MK');
        $query = $this->db->get();
        return $query->result();
    }
   
    function insert($data)
    {
     $this->db->insert_batch('mata_kuliah', $data);
    }
}

?>