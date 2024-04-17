<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/head');
		$this->load->view('pegawai/pegawai');
		$this->load->view('partials/footer');
	}
}
