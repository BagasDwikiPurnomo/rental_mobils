<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_car_details($car_id) {
        $this->db->where('car_id', $car_id);
        $query = $this->db->get('cars');
        return $query->row(); // Fetch a single row
    }

    // Fetch car details by ID
    public function get_car_by_id($car_id) {
        $query = $this->db->get_where('cars', array('car_id' => $car_id));
        return $query->row_array();
    }

    public function insert_rental($data) {
        return $this->db->insert('rentals', $data);
    }
}
?>
