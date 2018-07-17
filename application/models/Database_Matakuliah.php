<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database_Matakuliah_Model extends CI_Model{
    function select()
    {
     $this->db->order_by('KODE_MATA_KULIAH', 'DESC');
     $query = $this->db->get('mata_kuliah');
     return $query;
    }
   
    function insert($data)
    {
     $this->db->insert_batch('mata_kuliah', $data);
    }
}

?>