<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

	public function my_profile()
	{
		$this->load->view('partials/head');
		$this->load->view('profile/my-profile');
		$this->load->view('partials/footer');
	}

    public function setting()
	{
		$this->load->view('partials/head');
		$this->load->view('profile/setting');
		$this->load->view('partials/footer');
	}
}
