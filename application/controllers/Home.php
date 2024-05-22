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
		// $pegawai = $this->login_model->current_user();

        // $data = array(
        //     'nama_pegawai' => ($pegawai) ? $pegawai->nama : "Guest",
		// 	'username'=> ($pegawai) ? $pegawai->username : "username",
        // );
		$this->load->view('partials/head');
		$this->load->view('home/home');
		$this->load->view('partials/footer');
	}
}
