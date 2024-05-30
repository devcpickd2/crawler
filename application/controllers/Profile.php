<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	const SESSION_KEY = 'user_uuid';

	public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		$this->load->model('pegawai_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

	public function my_profile()
	{
		$uuid = $this->session->userdata(self::SESSION_KEY);
		$data['pegawai'] = $this->pegawai_model->get_by_uuid($uuid);

		$this->load->view('partials/head');
		$this->load->view('profile/my-profile', $data);
		$this->load->view('partials/footer');
	}

    public function setting()
	{
		$uuid =  $this->session->userdata(self::SESSION_KEY);
		$pegawai = $this->pegawai_model->get_by_uuid($uuid);
		
		$this->load->view('partials/head');
		$this->load->view('profile/setting', ['pegawai'=>$pegawai]);
		$this->load->view('partials/footer');
	}

	public function submit_edit() {
		$uuid = $this->session->userdata(self::SESSION_KEY);
		$password = $this->input->post('password');

		if (!empty($password)) {
			$data = array(
				'password' => password_hash($password, PASSWORD_BCRYPT),
			);

			$update = $this->pegawai_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Password berhasil diupdate');
				log_message('debug', 'Password berhasil diupdate');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate password');
				log_message('debug', 'Gagal mengupdate password');
			}
		} else {
			$this->session->set_flashdata('error_msg', 'Password tidak boleh kosong');
			log_message('debug', 'Password tidak boleh kosong');
		}

		redirect('setting');
	}
}
