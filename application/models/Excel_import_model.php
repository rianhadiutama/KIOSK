<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Excel_import_model extends CI_Model{
    function view(){
        return $this->db->get('nilai')->result();
    }
    function select()
    {
     $this->db->order_by('ID_NILAI', 'DESC');
     $query = $this->db->get('nilai');
     return $query;
    }
   
    function insert($data)
    {
     $this->db->insert_batch('nilai', $data);
    }
}

?>