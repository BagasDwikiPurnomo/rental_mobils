<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('User/User_model'); // Load the User_model
      $this->load->library('form_validation'); // Load form validation library
      $this->load->library('session');
  }

    public function index()
    {
       $this->load->view('Login-register/login_view');
    }
 

    public function login() {
      // Set validation rules
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == FALSE) {
          // Load the login view with validation errors
          $this->load->view('Login-register/login_view');
      } else {
          $email = $this->input->post('email');
          $password = $this->input->post('password');

          // Check user credentials
          $user = $this->User_model->check_user($email, $password);

          if ($user) {
            $this->session->set_userdata(array(
                'user_id' => $user->user_id,
                'username' => $user->username,
            ));

              // Redirect to the dashboard or home page
              redirect('');
          } else {
              // Set an error message
              $this->session->set_flashdata('error', 'Invalid email or password');
              // Reload the login view
              redirect('login');
          }
      }
  }

  public function logout() {
      // Destroy the session data
      $this->session->sess_destroy();
      // Redirect to login page
      redirect('');
  }
 }
 



?>