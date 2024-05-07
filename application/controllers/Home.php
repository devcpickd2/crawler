<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

	public function index()
	{
		$this->load->view('partials/head');
		$this->load->view('home/home');
		$this->load->view('partials/footer');
	}
}
