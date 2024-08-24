<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User/User_model'); // Load model User_model
        $this->load->library('session');
        $this->load->helper('url'); // Load URL helper for redirect
        $this->load->helper('form'); // Load form helper for set_value()
    }

    public function index() {
        $this->load->view('Login-register/Register_view');
    }

    public function register() {
        // Ambil data dari input form
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error', 'Format email tidak valid.');
            $data = array('username' => $username, 'email' => $email); // Preserve input data
            $this->load->view('Login-register/Register_view', $data);
            return;
        }

        // Cek apakah email sudah ada di database
        if ($this->User_model->check_email_exists($email)) {
            $this->session->set_flashdata('error', 'Email sudah digunakan. Silakan gunakan email lain.');
            $data = array('username' => $username, 'email' => $email); // Preserve input data
            $this->load->view('Login-register/Register_view', $data);
            return;
        }

        // Cek apakah username sudah ada di database
        if ($this->User_model->check_username_exists($username)) {
            $this->session->set_flashdata('error', 'Username sudah digunakan. Silakan gunakan username lain.');
            $data = array('username' => $username, 'email' => $email); // Preserve input data
            $this->load->view('Login-register/Register_view', $data);
            return;
        }

        // Jika email dan username belum ada, proses registrasi
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT), // Hash password
            'verif_token' => bin2hex(random_bytes(16)), // Token verifikasi
            'role' => 'user' // Default role
        );

        if ($this->User_model->insert_user($data)) {
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan. Silakan coba lagi.');
            $this->load->view('Login-register/Register_view', $data);
        }
    }
}
?>
