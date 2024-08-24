<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Example of handling the filter in the controller

    public function index() {
        // Get filter values from query parameters
        $search = $this->input->get('search');
        $car_year = $this->input->get('car-year');
        $brand = $this->input->get('brand');

        // Initialize query
        $this->db->select('*');
        $this->db->from('cars');

        // Apply filters if they are not empty
        if (!empty($search)) {
            $this->db->like('name', $search);
            $this->db->or_like('merk', $search);
        }

        if (!empty($car_year)) {
            $this->db->where('year', $car_year);
        }

        if (!empty($brand)) {
            if ($brand !== '') { // Ignore empty (All) option
                $this->db->where('brand', $brand);
            }
        }

        // Execute the query and fetch results
        $query = $this->db->get();
        $data['cars'] = $query->result_array();

        // Load view with data
        $this->load->view('Admin/cars_list_view', $data);
    }


    // Existing functions...
    public function get_all_cars() {
        return $this->db->get('cars')->result_array();
    }

    public function add_car($data) {
        return $this->db->insert('cars', $data);
    }

    

    public function check_user($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('role', 'admin'); // Check if role is 'admin'
        $query = $this->db->get('user');
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user; // Return user data if password matches
            }
        }
        return false; // Return false if user not found or password doesn't match
    }

    // Car_model.php
    public function get_car_by_id($id) {
        $query = $this->db->get_where('cars', array('car_id' => $id));
        return $query->row_array();
    }
    
    public function update_car($id, $data) {
        $this->db->where('car_id', $id);
        return $this->db->update('cars', $data);
    }
    

    public function get_filtered_cars($search = '', $date = '', $brand = '') {
        $this->db->select('*');
        $this->db->from('cars');
        
        // Apply search filter
        if ($search) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('merk', $search);
            $this->db->group_end();
        }
        
        // Apply date filter to include cars from the selected year and earlier
        if ($date) {
            $this->db->where('date <=', $date);
        }
        
        // Apply brand filter
        if ($brand) {
            $this->db->where('merk', $brand);
        }
        
        // Execute the query
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }
    
    
    public function get_all_brands() {
        $this->db->distinct();
        $this->db->select('merk');
        $this->db->from('cars');
        $query = $this->db->get();
        return array_column($query->result_array(), 'merk');
    }
    

    public function delete_car($id) {
        // Hapus data mobil berdasarkan ID
        $this->db->where('car_id', $id);
        return $this->db->delete('cars'); // Ganti 'cars' dengan nama tabel yang sesuai
    }

    
}
?>
