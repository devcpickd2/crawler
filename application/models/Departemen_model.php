<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Departemen_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		// $this->load->model('auth_model');
	}
	
	public function rules()
	{
		return[
			[
				'field' => 'departemen',
				'label' => 'Departmen',
				'rules' => 'required'
			]
		];
	}


	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$departemen = $this->input->post('departemen');
		// $user_uuid = $this->session->userdata('username');

		$data = array(
			'uuid' => $uuid,
			// 'user_uuid' => $user_uuid,
			'departemen' => $departemen
		);

		$this->db->insert('departemen', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{

		$departemen = $this->input->post('departemen');
		// $user_uuid = $this->session->userdata('username');

		$data = array(
			// 'user_uuid' => $user_uuid,
			'departemen' => $departemen,

			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->update('departemen', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$data = $this->db->get('departemen')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('departemen', array('uuid' => $uuid))->row();
		return $data;
	}
}