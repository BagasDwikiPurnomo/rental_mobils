<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Midtrans_lib');
    }

    public function index() {
        // Contoh data transaksi
        $transaction_data = array(
            'transaction_details' => array(
                'order_id' => 'order-' . time(),
                'gross_amount' => 100000
            ),
            'credit_card' => array(
                'secure' => true
            )
        );

        // Mengirim permintaan untuk mendapatkan token
        $snap_token = $this->Midtrans_lib->getSnapToken($transaction_data);

        // Mengembalikan token ke view atau langsung ke frontend
        $data['snap_token'] = $snap_token;
        $this->load->view('payment_view', $data);
    }
}
