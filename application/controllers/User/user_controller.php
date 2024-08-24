<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('User/User_model');
        $this->load->database();  // Pastikan library database dimuat
        $this->check_login();
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        // $this->load->view('Login-register/Login_view', $data);
        $this->load->view('User/User_view', $data);
    }

    private function check_login() {
        if (!$this->session->userdata('role')) {
            redirect('Admin/Admin_controller');
        }
    }

    public function create() {
        $this->load->view('User/User_form');
    }

    public function login() {
        $this->load->view('Login-register/Login_view');
    }

    public function register() {
        $this->load->view('Login-register/Register_view');
    }

    public function store() {
        // Ambil data dari POST request
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
    
        // Validasi form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Return validation errors as JSON
            $errors = $this->form_validation->error_array();
            echo json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
        } else {
            // Periksa apakah email atau username sudah ada
            if ($this->User_model->check_email_exists($email)) {
                // Set flashdata error
                $this->session->set_flashdata('error', 'Email already exists.');
                redirect('User/User_controller');
            } elseif ($this->User_model->check_username_exists($username)) {
                // Set flashdata error
                $this->session->set_flashdata('error', 'Username already exists.');
                redirect('User/User_controller');
            } else {
                // Enkripsi password
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
                // Data untuk disimpan
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => $password_hash,
                    'role' => $role
                );
    
                // Simpan data
                $this->User_model->insert_user($data);
    
                // Set flashdata success
                $this->session->set_flashdata('success', 'User created successfully.');
                redirect('User/User_controller');
            }
        }
    }
    
    
    public function edit($user_id) {
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('User/User_form', $data);
    }

    public function update($id) {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('new-password');
        $role = $this->input->post('role');

        // Validasi form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            echo json_encode(['status' => 'error', 'message' => 'Validation failed', 'errors' => $errors]);
        } else {
            $data = [
                'username' => $username,
                'email' => $email,
                'role' => $role,
            ];

            if (!empty($password)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $data['password'] = $password_hash;
            }

            $updated = $this->User_model->update_user($id, $data);

            if ($updated) {
                $this->session->set_flashdata('success', 'User updated successfully.');
                echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
                redirect('User/User_controller');
            } else {
                $this->session->set_flashdata('success', 'User updated successfully.');
                echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);                
                redirect('User/User_controller');
            }
        }
    }
    
    
    public function delete($user_id) {
        $this->User_model->delete_user($user_id);
        redirect('User/User_controller');
    }
}
