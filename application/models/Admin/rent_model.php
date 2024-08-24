<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rent_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_filtered_rentals($search = '', $start_date = '', $end_date = '') {
        $this->db->select('rentals.id, user.user_id, user.username, rentals.car_name, rentals.start_date, rentals.end_date, rentals.total_price');
        $this->db->from('rentals');
        $this->db->join('user', 'user.user_id = rentals.user_id', 'left');
    
        // Apply filters
        if ($search) {
            $this->db->group_start();
            $this->db->like('rentals.car_name', $search);
            $this->db->or_like('user.username', $search);
            $this->db->group_end();
        }
        if ($start_date && $end_date) {
            $this->db->where('rentals.start_date >=', $start_date);
            $this->db->where('rentals.end_date <=', $end_date);
        }
    
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function get_car_names() {
        $this->db->distinct();
        $this->db->select('car_name');
        $this->db->from('rentals');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function delete_rental($id) {
        // Delete the rental record by ID
        $this->db->where('id', $id);
        return $this->db->delete('rentals');
    }
}