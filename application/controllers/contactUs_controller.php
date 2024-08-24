<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class contactUs_controller extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->library('form_validation');
  }

    public function index()
    {
       $this->load->view('Cars/contactUs_view');
    }

    public function send_message() {
      // Validate form inputs
      $this->form_validation->set_rules('name', 'Full Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('message', 'Message', 'required');
  
      if ($this->form_validation->run() == FALSE) {
          // Validation failed, return with errors
          $this->session->set_flashdata('error', validation_errors());
          redirect('contactus?scroll=notification');
      } else {
          // Validation succeeded, prepare data for webhook
          $name = $this->input->post('name');
          $email = $this->input->post('email');
          $message = $this->input->post('message');
          $current_time = date('Y-m-d H:i:s');
  
          $webhook_url = 'https://discord.com/api/webhooks/1276019790594703371/TvT991es-pLaUexXIpqYgsUCGN95WOA-HH2Zc2K5a1Z8YmnYdW8BNWWNYPAorDPkqv8r';
          $payload = json_encode([
              'content' => null,
              'embeds' => [
                  [
                      'title' => 'Contact Form Submission',
                      'description' => 'A new message has been received from the contact form.',
                      'color' => 0x000000, // Black color
                      'fields' => [
                          [
                              'name' => 'Full Name',
                              'value' => $name,
                              'inline' => true
                          ],
                          [
                              'name' => 'Email',
                              'value' => $email,
                              'inline' => true
                          ],
                          [
                              'name' => 'Message',
                              'value' => $message,
                              'inline' => false
                          ],
                          [
                              'name' => 'Received At',
                              'value' => $current_time,
                              'inline' => false
                          ]
                      ],
                      'footer' => [
                          'text' => 'Contact Form',
                      ]
                  ]
              ]
          ]);
  
          // Send request to Discord webhook
          $ch = curl_init($webhook_url);
          curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          
          if (curl_errno($ch)) {
              // Capture curl errors
              $error_msg = curl_error($ch);
              $this->session->set_flashdata('error', 'Failed to send message: ' . $error_msg);
              $redirect_url = 'contactus?scroll=notification';
          } else {
              // Check if response is valid
              $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
              if ($http_code == 204) {
                  $this->session->set_flashdata('success', 'Your message has been sent successfully!');
                  $redirect_url = 'contactus?scroll=notification';
              } else {
                  $this->session->set_flashdata('error', 'Failed to send message. HTTP Code: ' . $http_code);
                  $redirect_url = 'contactus?scroll=notification';
              }
          }
          
          curl_close($ch);
          redirect($redirect_url);
      }
  }
}
