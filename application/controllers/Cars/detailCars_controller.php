<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class detailCars_controller extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('Cars/detailCars_model'); // Load the Car_model
  }

    public function index()
    {
       $this->load->view('Cars/detailCars_view');
    }
 
    public function details($car_id) {
      // Fetch car details from the model
      $data['car'] = $this->detailCars_model->get_car_details($car_id);
      
      // Check if the car data is found
      if ($data['car']) {
          $this->load->view('Cars/detailCars_view', $data); // Load the view with car data
      } else {
          show_404(); // Show a 404 page if no data is found
      }
  }
 }


?>