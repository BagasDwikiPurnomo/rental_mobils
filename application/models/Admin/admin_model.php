<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Existing functions...

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
}
?>
