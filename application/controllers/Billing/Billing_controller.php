<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Billing/Billing_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function index() {
        $this->load->view('Billing/billing_view');
    }
 
    public function billing($car_id) {
        // Fetch car details from the model
        $data['car'] = $this->Billing_model->get_car_details($car_id);
        
        // Check if the car data is found
        if ($data['car']) {
            $this->load->view('Billing/billing_view', $data); // Load the view with car data
        } else {
            show_404(); // Show a 404 page if no data is found
        }
    }

    public function save_rental() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'error', 'message' => 'User not logged in')));
            return;
        }

        // Retrieve data from POST request
        $user_id = $this->session->userdata('user_id');
        $car_name = $this->input->post('car_name');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');    
        $total_price = $this->input->post('total_price');

        // Validation
        if (empty($car_name) || empty($start_date) || empty($end_date) || empty($total_price)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'error', 'message' => 'Please fill in all required fields')));
            return;
        }
    
        // Convert dates to DateTime objects to ensure proper formatting
        $start_date = new DateTime($start_date);
        $end_date = new DateTime($end_date);

        // Load Midtrans and configure
        $params = array('server_key' => 'SB-Mid-server-_Q9h1YPlp2rF99l-nkVcKj32', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);

        // Prepare transaction data
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $total_price, // Assuming $total_price is an integer
        );

        // Prepare customer details
        $customer_details = array(
            'first_name' => $this->session->userdata('first_name'),
            'last_name' => $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'phone' => $this->session->userdata('phone'),
        );

        // Prepare the transaction data for Midtrans
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );

        // Get the Snap Token
        $snapToken = $this->midtrans->getSnapToken($transaction_data);

        // Return the Snap Token as a JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('status' => 'success', 'snapToken' => $snapToken)));
    }

    public function finish_payment() {
        $result = json_decode($this->input->post('result_data'));

          // Check if the payment was successful
    if ($result->status_code == '200') {
        // Retrieve data from POST request
        $car_name = $this->input->post('car_name');
        $start_date = new DateTime($this->input->post('start_date'));
        $end_date = new DateTime($this->input->post('end_date'));
        $total_price = $result->gross_amount;

        // Insert rental data into the database
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'car_name' => $car_name,
            'start_date' => $start_date->format('Y-m-d H:i:s'),
            'end_date' => $end_date->format('Y-m-d H:i:s'),
            'total_price' => $total_price
        );


            if ($this->Billing_model->insert_rental($data)) {
                // Return a success message
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'success', 'message' => 'Rental data saved successfully')));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'error', 'message' => 'Failed to save rental data')));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'error', 'message' => 'Payment failed')));
        }
    }
}
?>
