<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Pem_Sanitasi_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
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
				'field' => 'pukul',
				'label' => 'Pukul',
				'rules' => 'required'
			],
			[
				'field' => 'foot_basin',
				'label' => 'Foot Basin',
				'rules' => 'required'
			],
			[
				'field' => 'hand_basin',
				'label' => 'Hand Basin',
				'rules' => 'required'
			],
			[
				'field' => 'keterangan',
				'label' => 'Keterangan',
				'rules' => 'required'
			],
            [
				'field' => 'tindakan_koreksi',
				'label' => 'Keterangan',
				'rules' => 'required'
			],
            [
				'field' => 'produksi',
				'label' => 'produksi',
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

		$date = $this->input->post('date');
		$shift = $this->input->post('shift');
		$pukul = $this->input->post('pukul');
		$foot_basin = $this->input->post('foot_basin');
		$hand_basin = $this->input->post('hand_basin');
		$keterangan = $this->input->post('keterangan');
		$tindakan_koreksi = $this->input->post('tindakan_koreksi');
		$produksi = $this->input->post('produksi');
		$catatan = $this->input->post('catatan');

		$data = array(
			'uuid' => $uuid,
			'date' => $this->input->post('date'),
            'shift' => $this->input->post('shift'),
            'pukul' => $this->input->post('pukul'),
            'foot_basin' => $this->input->post('foot_basin'),
            'hand_basin' => $this->input->post('hand_basin'),
            'keterangan' => $this->input->post('keterangan'),
            'tindakan_koreksi' => $this->input->post('tindakan_koreksi'),
            'qc' => $this->session->userdata('user_uuid'),
            'produksi' => $this->input->post('produksi'),
            'catatan' => $this->input->post('catatan')
		);

		$this->db->insert('pem_sanitasi', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}
    public function get_all(){
		// $this->db->order_by('created_at', 'DESC');
        // $query = $this->db->get('pem_sanitasi');
        // return $query->result();

        $this->db->select('pem_sanitasi.*, pegawai.nama as nama_pegawai');
        $this->db->join('pegawai', 'pegawai.uuid = pem_sanitasi.qc', 'left');
        $this->db->order_by('pem_sanitasi.created_at', 'DESC');
        $query = $this->db->get('pem_sanitasi');
        return $query->result();
    }

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('pem_sanitasi', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('pem_sanitasi');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('pem_sanitasi');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
	public function get_by_date($tanggal)
    {
        $this->db->where('date', $tanggal);
        return $this->db->get('pem_sanitasi')->result();
    }

}