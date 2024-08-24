<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class allCars_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fetch all cars
    public function get_all_cars() {
        $query = $this->db->get('cars');
        return $query->result_array();
    }
    
    // Fetch car details by ID
    public function get_car_by_id($car_id) {
        $query = $this->db->get_where('cars', array('car_id' => $car_id));
        return $query->row_array();
    }
}
?>
