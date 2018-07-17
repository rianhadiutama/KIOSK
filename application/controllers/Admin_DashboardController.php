<?php
/*
|
|   UNTUK MENAMPILKAN MAIN MENU DARI APLIKASI KIOSK
|
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_DashboardController extends CI_Controller {
    function __construct()
	{
        parent::__construct();
    }
    function dashboard_view(){
		$this->load->view('admin_dashboard');
    }
}
?>