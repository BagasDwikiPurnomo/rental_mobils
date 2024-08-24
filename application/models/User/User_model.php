<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_users() {
        return $this->db->get('user')->result_array();
    }

    public function get_user_by_id($user_id) {
        return $this->db->get_where('user', array('user_id' => $user_id))->row_array();
    }

    public function insert_user($data) {
        return $this->db->insert('user', $data);
    }

    public function update_user($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }
    
    public function delete_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->delete('user');
    }

    // Check if email exists
    public function check_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }

    // Check if username exists
    public function check_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }

    public function check_user($email, $password) {
        $this->db->where('email', $email);
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
