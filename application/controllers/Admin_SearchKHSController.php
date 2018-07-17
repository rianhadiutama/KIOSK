<?php
/*
|
|   UNTUK MENAMPILKAN MAIN MENU DARI APLIKASI KIOSK
|
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_SearchKHSController extends CI_Controller {
    function __construct()
	{
        parent::__construct();
        $this->load->model('Database_KHS_Model');
    }
    function search(){
        $nim = $this->input->post('search');
        //if(isset('nim') and !empty('nim')){

//        }
    }

    
    function fetch(){
        $data = $this->Database_KHS_Model->select();
        $output = '
        <table class="table table-striped table-bordered">
        <tr>
            <th>KODE MATA KULIAH</th>
            <th>MATA KULIAH</th>
            <th>SKS</th>

        </tr>
        ';
        foreach($data->result() as $row)
        {
        $output .= '
        <tr>
            <td>'.$row->KODE_MATA_KULIAH.'</td>
            <td>'.$row->NAMA_MATA_KULIAH.'</td>
            <td>'.$row->SKS.'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        echo $output;
    }
}
?>