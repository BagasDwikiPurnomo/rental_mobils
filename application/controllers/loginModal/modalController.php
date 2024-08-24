<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModalController extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('loginModal/modalModel'); // Load the Car_model
  }

    public function index()
    {
       $this->load->view('Modal/modalView');
    }
 
    
 }


?>