<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Sortasi_Cooking_model extends CI_Model {
	
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
				'field' => 'nama_bahan',
				'label' => 'Nama Bahan',
				'rules' => 'required'
			],
			[
				'field' => 'kode_produksi',
				'label' => 'Kode Produksi',
				'rules' => 'required'
			],
			[
				'field' => 'jumlah_bahan_sebelum',
				'label' => 'Jumlah Bahan sebelum',
				'rules' => 'required'
			],
            [
				'field' => 'sesuai',
				'label' => 'Sesuai'
			],
            [
				'field' => 'tidak_Sesuai',
				'label' => 'Tidak Sesuai'
			],
			[
				'field' => 'tindakan_koreksi',
				'label' => 'Tindakan Koreksi',
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
		$nama_bahan = $this->input->post('nama_bahan');
		$kode_produksi = $this->input->post('kode_produksi');
		$jumlah_bahan_sebelum = $this->input->post('jumlah_bahan_sebelum');
		$sesuai = $this->input->post('sesuai');
		$tidak_sesuai = $this->input->post('tidak_sesuai');
		$tindakan_koreksi = $this->input->post('tindakan_koreksi');
		$catatan = $this->input->post('catatan');

		$data = array(
			'uuid' => $uuid,
			'date' => $this->input->post('date'),
            'shift' => $this->input->post('shift'),
            'nama_bahan' => $this->input->post('nama_bahan'),
            'kode_produksi' => $this->input->post('kode_produksi'),
            'jumlah_bahan_sebelum' => $this->input->post('jumlah_bahan_sebelum'),
            'sesuai' => $this->input->post('sesuai'),
            'tidak_sesuai' => $this->input->post('tidak_sesuai'),
            'tindakan_koreksi' => $this->input->post('tindakan_koreksi'),
            'catatan' => $this->input->post('catatan')
		);

		$this->db->insert('sortasi_tdksesuai', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}
    public function get_all(){
		$this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('sortasi_tdksesuai');
        return $query->result();
    }

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('sortasi_tdksesuai', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('sortasi_tdksesuai');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('sortasi_tdksesuai');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
	public function get_by_date($tanggal)
    {
        $this->db->where('date', $tanggal);
        return $this->db->get('sortasi_tdksesuai')->result();
    }

}