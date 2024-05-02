<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('auth_model');
		$this->load->model('departemen_model');
		$this->load->model('pegawai_model');
		$this->load->library('form_validation');

		// if(!$this->auth_model->current_user()){
		// 	redirect('login');
		// }
	}

	public function index()
	{
		$data = array(
			// 'departemen' => $this->departemen_model->get_all(),
			'pegawai' => $this->pegawai_model->get_all(),
			'active_nav' => 'pegawai', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai');
		$this->load->view('partials/footer');
	}
	
	public function tambah(){
		$rules = $this->pegawai_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->pegawai_model->insert();

			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pegawai berhasil di simpan');
				redirect('pegawai');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pegawai gagal di simpan');
				redirect('pegawai');
			}
		}

		$data = array(
			'departemen' => $this->departemen_model->get_all(),
			'active_nav' => 'pegawai', 
		);

		$this->load->view('partials/head');
		$this->load->view('pegawai/pegawai-tambah');
		$this->load->view('partials/footer');
	}
}
