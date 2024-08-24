<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin/Admin_model');
        $this->load->library('form_validation'); // Load form validation library
        $this->load->library('session');
        $this->load->database();  // Pastikan library database dimuat
    }

    public function index()
    {
       $this->load->view('Admin/admin_view');
    }

    public function login() {
        $this->form_validation->set_rules('Username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Admin/admin_view');
        } else {
            $username = $this->input->post('Username');
            $password = $this->input->post('password');

            $user = $this->Admin_model->check_user($username, $password);

            if ($user) {
                // Set session data
                $this->session->set_userdata(array(
                    'user_id' => $user->user_id,
                    'username' => $user->username,
                    'role' => $user->role
                ));
                
                // Redirect to the dashboard
                redirect('dashboard'); // Assuming 'dashboard' is the route to your dashboard
            } else {
                // Set error message and reload login page
                $this->session->set_flashdata('error', 'Invalid login credentials.');
                redirect('Admin/Admin_controller'); // Assuming 'admin_controller' is the route to your login page
            }
        }
    }

    public function logout() {
      // Hapus semua data sesi
      $this->session->sess_destroy();
      
      // Redirect ke halaman login
      redirect('Admin/Admin_controller');
  }
  
}
?>
