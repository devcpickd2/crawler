<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Verif_Institusi_model extends CI_Model {
	
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
				'field' => 'jenis_produk',
				'label' => 'Jenis Produk',
				'rules' => 'required'
			],
			[
				'field' => 'kode_produksi',
				'label' => 'Kode Produksi',
				'rules' => 'required'
			],
			[
				'field' => 'waktu_proses',
				'label' => 'Waktu Proses',
				'rules' => 'required'
			],
			[
				'field' => 'lokasi',
				'label' => 'Lokasi',
				'rules' => 'required'
			],
			[
				'field' => 'sebelum',
				'label' => 'Sebelum',
				'rules' => 'required'
			],
			[
				'field' => 'sesudah',
				'label' => 'Sesudah',
				'rules' => 'required'
			],
			[
				'field' => 'sensori',
				'label' => 'Sensori',
				'rules' => 'required'
			],
			[
				'field' => 'qc',
				'label' => 'QC',
				'rules' => 'required'
			],
			[
				'field' => 'produksi',
				'label' => 'Produksi',
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
		$jenis_produk = $this->input->post('jenis_produk');
		$kode_produksi = $this->input->post('kode_produksi');
		$waktu_proses = $this->input->post('waktu_proses');
		$lokasi = $this->input->post('lokasi');
		$sebelum = $this->input->post('sebelum');
		$sesudah = $this->input->post('sesudah');
		$sensori = $this->input->post('sensori');
		$qc = $this->input->post('qc');
		$produksi = $this->input->post('produksi');
		$catatan = $this->input->post('catatan');

		$data = array(
			'uuid' => $uuid,
			'date' => $this->input->post('date'),
            'shift' => $this->input->post('shift'),
            'jenis_produk' => $this->input->post('jenis_produk'),
            'kode_produksi' => $this->input->post('kode_produksi'),
            'waktu_proses' => $this->input->post('waktu_proses'),
            'lokasi' => $this->input->post('lokasi'),
            'sebelum' => $this->input->post('sebelum'),
            'sesudah' => $this->input->post('sesudah'),
            'sensori' => $this->input->post('sensori'),
			'qc' => $this->input->post('qc'),
			'produksi' => $this->input->post('produksi'),
            'catatan' => $this->input->post('catatan')
		);

		$this->db->insert('verifikasi_institusi', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}
    public function get_all(){
		$this->db->order_by('date', 'DESC');
        $query = $this->db->get('verifikasi_institusi');
        return $query->result();
    }

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('verifikasi_institusi', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('verifikasi_institusi');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('verifikasi_institusi');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
	public function get_by_date($tanggal)
    {
        $this->db->where('date', $tanggal);
        return $this->db->get('verifikasi_institusi')->result();
    }

}