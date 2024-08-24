<?php 
class History_model extends CI_Model {
   public function __construct() {
      $this->load->database();
   }

   public function get_car_history($user_id) {
      $this->db->select('r.car_name, r.start_date, r.end_date, r.total_price, c.logo');
      $this->db->from('rentals r'); // Replace with your actual rentals table name
      $this->db->join('cars c', 'r.car_name = c.name'); // Adjust the join condition if needed
      $this->db->where('r.user_id', $user_id);
      $query = $this->db->get();

      return $query->result();
   }
}
?>
