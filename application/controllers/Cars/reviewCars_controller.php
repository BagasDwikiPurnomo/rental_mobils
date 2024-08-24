<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewCars_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cars/ReviewCars_model');
    }

    public function index($car_id = null) {
        // Fetch all cars
        $data['cars'] = $this->ReviewCars_model->get_all_cars();

        // Fetch a specific car if an ID is provided
        if ($car_id) {
            $data['car'] = $this->ReviewCars_model->get_car_by_id($car_id);
        } else {
            $data['car'] = null;
        }

        // Load the view
        $this->load->view('Cars/reviewCars_view', $data);
    }
}
?>
