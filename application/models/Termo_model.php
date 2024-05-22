<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Termo_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('auth_model');
	}
	public function rules(){
		return [
			[
				'field' => 'date',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'shift',
				'label' => 'Shift',
				'rules' => 'required'
			],
			[
				'field' => 'kode_termo',
				'label' => 'Kode Termometer/Area',
				'rules' => 'required'
			],
			[
				'field' => 'pukul',
				'label' => 'Pukul',
				'rules' => 'required'
			],
			[
				'field' => 'hasil_tera',
				'label' => 'Hasil Tera',
				'rules' => 'required'
			],
			[
				'field' => 'tindakan',
				'label' => 'Tindakan',
				'rules' => 'required'
			],
			[
				'field' => 'catatan',
				'label' => 'Catatan'
			]
		];
	}

	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		// $date = $this->input->post('date');
		// $shift = $this->input->post('shift');
		// $kode_termo = $this->input->post('kode_termo');
		// $pukul = $this->input->post('pukul');
		// $hasil_tera = $this->input->post('hasil_tera');
		// $tindakan = $this->input->post('tindakan');
		// $catatan = $this->input->post('catatan');

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
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('peneraan_termo');
        return $query->result();
    }

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('peneraan_termo', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('peneraan_termo');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('peneraan_termo');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
	public function get_by_date($tanggal)
    {
        $this->db->where('date', $tanggal);
        return $this->db->get('peneraan_termo')->result();
    }

}