<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class allCars_controller extends CI_Controller {
   public function __construct() {
   parent::__construct();
   $this->load->model('Cars/allCars_model');
   $this->load->library('form_validation'); // Load the form validation library
   $this->load->database();  // Ensure the database library is loaded
}
    
    public function index()
    {
      $data['cars'] = $this->allCars_model->get_all_cars();
        $this->load->view('Cars/allCars_view', $data); // Pass data to the view
    }

    public function store() {
        // Your form validation logic here
        $this->form_validation->set_rules('field_name', 'Field Label', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            // Handle validation errors
        } else {
            // Process form data
        }
    }
}

?>