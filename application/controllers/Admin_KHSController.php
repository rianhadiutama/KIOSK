<?php
/*
|
|   UNTUK MENAMPILKAN KHS DARI APLIKASI KIOSK
|
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_KHSController extends CI_Controller {
    function __construct()
	{
        parent::__construct();
    }
    function khs_view(){
		$this->load->view('admin_khs');
    }
}
?>