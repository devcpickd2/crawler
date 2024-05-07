<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('departemen_model');
		$this->load->model('pegawai_model');
		$this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
	}

	public function index()
	{
		$data = array(
			'departemen' => $this->departemen_model->get_all(),
			'active_nav' => 'departemen', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('departemen/departemen', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->departemen_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->departemen_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Departemen berhasil di simpan');
				redirect('departemen');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Departemen gagal di simpan');
				redirect('departemen');
			}
		}

		$data = array(
			'active_nav' => 'departemen');

		$this->load->view('partials/head', $data);
		$this->load->view('departemen/departemen-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->departemen_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->departemen_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Departemen berhasil di Update');
				redirect('departemen');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Departemen gagal di Update');
				redirect('departemen');
			}
		}

		$data = array('departemen' => $this->departemen_model->get_by_uuid($uuid),
			'active_nav' => 'departemen');

		$this->load->view('partials/head', $data);
		$this->load->view('departemen/departemen-edit', $data);
		$this->load->view('partials/footer');
	}
}
