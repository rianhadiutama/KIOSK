<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database_Nilai extends CI_Model{
    function ambil_data(){
        $this->db->select('*');
        $this->db->from('nilai');
        $this->db->join('mata_kuliah', 'mata_kuliah.KODE_MATA_KULIAH = nilai.KODE_MK');
        $query = $this->db->get();
        return $query->result();
    }
    function select()
    {
     $this->db->order_by('ID_NILAI', 'ASC');
     $query = $this->db->get('nilai');
     return $query;
    }
   
    function insert($data)
    {
     $this->db->insert_batch('nilai', $data);
    }
}

?>
