<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewCars_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_car_by_id($car_id) {
        $this->db->where('car_id', $car_id);
        $query = $this->db->get('cars');
        return $query->row_array(); // Return a single row as an associative array
    }

    public function get_all_cars() {
        $query = $this->db->get('cars');
        return $query->result_array(); // Return all rows as an array of associative arrays
    }
}
?>
