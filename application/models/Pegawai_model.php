<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Pegawai_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();

		// $this->load->model('auth_model');
	}

	public function rules()
	{
		return[
			[
				'field' => 'nama',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				// 'rules' => 'valid_email',
				// 'errors' => array('valid_email' => 'Masukkan alamat email yang valid.')
			],
			[
				'field' => 'departemen',
				'label' => 'Department',
				'rules' => 'required'
			],
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|is_unique[pegawai.username]'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
				// 'rules' => 'required|min_length[8]'
			],
			[
				'field' => 'tipe_user',
				'label' => 'User Type',
				'rules' => 'required'
			]
		];
	}

	public function update_rules()
	{
		return[
			[
				'field' => 'nama',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				// 'rules' => 'valid_email',
				// 'errors' => array('valid_email' => 'Masukkan alamat email yang valid.')
			],
			[
				'field' => 'departemen',
				'label' => 'Department',
				'rules' => 'required'
			],
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
				// 'rules' => 'required|min_length[8]'
			],
			[
				'field' => 'tipe_user',
				'label' => 'User Type',
				'rules' => 'required'
			]
		];
	}


	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$departemen = $this->input->post('departemen');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = password_hash($password, PASSWORD_BCRYPT);
		$tipe_user = $this->input->post('tipe_user');
		// $user_uuid = $this->session->userdata('username');

		$data = array(
			'uuid' => $uuid,
			// 'user_uuid' => $user_uuid,
			'nama' => $nama,
			'email' => $email,
			'username' => $username,
			'password' => $password,
			'departemen' => $departemen,
			'tipe_user' => $tipe_user
		);

		$this->db->insert('pegawai', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('pegawai', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_all(){
        $this->db->select('pegawai.*, departemen.departemen');
		$this->db->from('pegawai');
		$this->db->join('departemen', 'departemen.uuid = pegawai.departemen');
		$query = $this->db->get();
		return $query->result();
    }
	public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('pegawai');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('pegawai');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}