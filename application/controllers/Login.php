<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('login_model');
		$this->load->library('form_validation');

	}

	// public function index() {
	// 	if ($this->session->userdata('logged_in')) {
	// 		redirect('home');
	// 	} else {
	// 		redirect('login/login');
	// 	}
	// }
	
	public function auth() {

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->login_model->login($username, $password)){
			redirect('home');
		} else {
			$this->session->set_flashdata('error_msg', 'Login Gagal, pastikan username dan password benar!');
			// redirect('login/login');
			$this->load->view('login/login');
		}	
	}

	public function login()
	{

		// if($this->login_model->current_user()){
		// 	redirect('home');
		// }
		
		// $rules = $this->login_model->rules();
		// $this->form_validation->set_rules($rules);

		// if($this->form_validation->run() == FALSE){
		// 	return $this->load->view('login/login');
		// }
		
		// $username = $this->input->post('username');
		// $password = $this->input->post('password');

		// if($this->login_model->login($username, $password)){
		// 	redirect('home');
		// } else {
		// 	$this->session->set_flashdata('error_msg', 'Login Gagal, pastikan username dan passwrod benar!');
			$this->load->view('login/login');
		// }		
	}

	// public function logout()
	// {
	// 	$this->login_model->logout();
	// 	// redirect(base_url());
	// }
	public function logout() {

        $this->session->sess_destroy();
        redirect('login');
    }

}
