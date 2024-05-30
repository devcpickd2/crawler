<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		$this->load->model('suhu_ruangan_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

	public function index()
	{

		$data['suhu_ruangan'] = $this->suhu_ruangan_model->get_all();

		$this->load->view('partials/head');
		$this->load->view('home/home', $data);
		$this->load->view('partials/footer');
	}
}
