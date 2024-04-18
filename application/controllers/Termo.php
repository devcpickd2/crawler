<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class termo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('auth_model');
		// $this->load->model('departemen_model');
		$this->load->model('termo_model');
		$this->load->library('form_validation');

		// if(!$this->auth_model->current_user()){
		// 	redirect('login');
		// }
	}

	public function index()
	{
		$data = array(
			'termo' => $this->termo_model->get_all(),
			'active_nav' => 'termo', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('cooking/termo');
		$this->load->view('partials/footer');
	}
	
	public function tambah()
    {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('shift', 'Shift', 'required');
        $this->form_validation->set_rules('kode_termo', 'Kode Termometer/Area', 'required');
        $this->form_validation->set_rules('pukul', 'Pukul', 'required');
        $this->form_validation->set_rules('hasil_tera', 'Hasil Tera', 'required');
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->termo_model->insert();

            if ($insert) {
                $this->session->flashdata('success_msg', 'Data peneraan termo berhasil disimpan');
                redirect('termo');
            } else {
                $this->session->flashdata('error_msg', 'Gagal menyimpan data peneraan termo');
                redirect('termo/tambah');
            }
        }

        $this->load->view('partials/head');
		$this->load->view('cooking/termo-tambah');
		$this->load->view('partials/footer');
    }
}
