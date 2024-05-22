<?php

class Login_model extends CI_Model
{
	private $_table = 'pegawai';
	const SESSION_KEY = 'user_uuid';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			]
		];
	}
	
	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		if (!$user) {
			return FALSE;
		}

		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		$this->session->set_userdata([self::SESSION_KEY => $user->uuid, 'username' => $user->username, 'type' => $user->tipe_user ]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_uuid = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['uuid ' => $user_uuid]);
		return $query->row();
	}


	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}