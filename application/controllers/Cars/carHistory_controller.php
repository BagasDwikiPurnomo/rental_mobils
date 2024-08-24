<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class carHistory_controller extends CI_Controller {
   public function __construct() {
      parent::__construct();
      $this->load->model('Cars/History_model'); // Load the model
      $this->load->helper('url');
   }

   public function index() {
      $user_id = $this->session->userdata('user_id'); // Get user ID from session
      if (!$user_id) {
          show_error('User not logged in', 403);
          return;
      }

      // Fetch car history data for the logged-in user
      $car_history = $this->History_model->get_car_history($user_id);
      
      // Convert end_date to ISO format for each history record
      foreach ($car_history as &$history) {
          $history->end_date_iso = (new DateTime($history->end_date))->format(DateTime::ATOM);
      }

      $data['car_history'] = $car_history;

      $this->load->view('Cars/carHistory_view', $data);       
   }
}
?>
