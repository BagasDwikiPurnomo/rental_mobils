<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Pastikan nama model sesuai dengan file dan kelasnya
    }

    public function index() {
        $data['users'] = $this->User_model->get_users(); // Sesuaikan dengan nama metode di model
        $this->load->view('user_view', $data); // Sesuaikan dengan nama view
    }

    public function create() {
        $this->load->view('user_create'); // Sesuaikan dengan nama view
    }

    public function store() {
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $this->User_model->insert_user($name, $description); // Sesuaikan dengan nama metode di model
        redirect('user_controller'); // Sesuaikan dengan nama controller
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_user($id); // Sesuaikan dengan nama metode di model
        $this->load->view('user_edit', $data); // Sesuaikan dengan nama view
    }

    public function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $this->User_model->update_user($id, $name, $description); // Sesuaikan dengan nama metode di model
        redirect('user_controller'); // Sesuaikan dengan nama controller
    }

    public function delete($id) {
        $this->User_model->delete_user($id); // Sesuaikan dengan nama metode di model
        redirect('user_controller'); // Sesuaikan dengan nama controller
    }


}




?>