<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Termo_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();

		// $this->load->model('auth_model');
	}


	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$date = $this->input->post('date');
		$shift = $this->input->post('shift');
		$kode_termo = $this->input->post('kode_termo');
		$pukul = $this->input->post('pukul');
		$hasil_tera = $this->input->post('hasil_tera');
		$tindakan = $this->input->post('tindakan');
		$catatan = $this->input->post('catatan');

		$data = array(
			'uuid' => $uuid,
			'date' => $this->input->post('date'),
            'shift' => $this->input->post('shift'),
            'kode_termo' => $this->input->post('kode_termo'),
            'pukul' => $this->input->post('pukul'),
            'hasil_tera' => $this->input->post('hasil_tera'),
            'tindakan' => $this->input->post('tindakan'),
            'catatan' => $this->input->post('catatan')
		);

		$this->db->insert('peneraan_termo', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}
    public function get_all(){
        $query = $this->db->get('peneraan_termo');
        return $query->result();
    }

}