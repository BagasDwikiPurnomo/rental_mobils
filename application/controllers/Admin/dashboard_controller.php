<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

    
    public function index()
    {
       $this->load->view('Admin/dashboard_view');
       $this->check_login(); // Memeriksa apakah pengguna sudah login
    }
 
    private function check_login() {
        // Cek jika sesi 'user_id' tidak ada
        if (!$this->session->userdata('role')) {
            // Redirect ke halaman login jika belum login
            redirect('Admin/Admin_controller');
        }
    }
    
 }
 



?>