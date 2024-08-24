<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Car_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cars/Car_model');
        $this->load->library('form_validation'); // Load the form validation library
        $this->load->database();  // Ensure the database library is loaded
    }

    public function index() {
        $cars = $this->Car_model->get_all_cars(); // Fetch all cars
    
        // Filter cars
        $filtered_cars = [];
        $count_bmw = 0;
        $count_mercedes = 0;
    
        foreach ($cars as $car) {
            if (strtolower($car['merk']) === 'bmw' && $count_bmw < 3) {
                $filtered_cars[] = $car;
                $count_bmw++;
            } elseif (strtolower($car['merk']) === 'mercedes' && $count_mercedes < 3) {
                $filtered_cars[] = $car;
                $count_mercedes++;
            }
    
            // Stop if we have 3 BMWs and 3 Mercedes
            if ($count_bmw >= 3 && $count_mercedes >= 3) {
                break;
            }
        }
    
        $data['cars'] = $filtered_cars;
        $this->load->view('Cars/car_view', $data); // Load the view with filtered cars
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
