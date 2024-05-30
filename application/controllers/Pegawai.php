<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_model');
		$this->load->model('pegawai_model');
		$this->load->library('form_validation');

		$this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
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
		$this->load->view('pegawai/pegawai-tambah', $data);
		$this->load->view('partials/footer');
	}

	public function edit($uuid)
	{
		$data = array(
			'pegawai' => $this->pegawai_model->get_by_uuid($uuid),
			'departemen' => $this->departemen_model->get_all(),
		);
		// var_dump($data);
		// exit();
		// $data['pegawai'] = $this->pegawai_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		$rules = $this->pegawai_model->update_rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$uuid = $this->input->post('uuid');
			$data['pegawai'] = $this->pegawai_model->get_by_uuid($uuid);

			$errors = validation_errors();

			$this->session->set_flashdata('error_msg', 'Gagal mengupdate data pegawai');
			redirect('pegawai/edit/' . $uuid);
		} else {
			$uuid = $this->input->post('uuid');
			$password = $this->input->post('password');

			$data = array(
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'departemen' => $this->input->post('departemen'),
				'tipe_user' => $this->input->post('tipe_user')
			);

			if (!empty($password)) {
				$data['password'] = password_hash($password, PASSWORD_BCRYPT);
			}

			$update = $this->pegawai_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data pegawai berhasil diupdate');
				redirect('pegawai');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data pegawai');
				redirect('pegawai/edit/' . $uuid);
			}
		}
	}

}
