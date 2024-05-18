<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Pem_Masak_Steamer_model extends CI_Model {
	
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
				'field' => 'nama_produk',
				'label' => 'Nama Produk',
				'rules' => 'required'
			],
            [
				'field' => 'kode_produksi',
				'label' => 'Kode Produksi',
				'rules' => 'required'
			],
			[
				'field' => 't_raw',
				'label' => 'T. Raw Material',
				'rules' => 'required'
			],
			[
				'field' => 'jumlah_tray',
				'label' => 'Jumlah Tray',
				'rules' => 'required'
			],
            [
				'field' => 't_ruang',
				'label' => 'Sesuai',
				'rules' => 'required'
			],
            [
				'field' => 't_produk',
				'label' => 'T. Produk',
				'rules' => 'required'
			],
			[
				'field' => 't_produk1menit',
				'label' => 'T Produk 1 Menit',
				'rules' => 'required'
			],
            [
				'field' => 'waktu',
				'label' => 'Waktu',
				'rules' => 'required'
			],
            [
				'field' => 'keterangan',
				'label' => 'Keterangan',
				'rules' => 'required'
			],
            [
				'field' => 'jam_mulai',
				'label' => 'Jam Mulai',
				'rules' => 'required'
			],
            [
				'field' => 'jam_selesai',
				'label' => 'Jam Selesai',
				'rules' => 'required'
			],
            [
				'field' => 'kematangan',
				'label' => 'Kematangan',
				// 'rules' => 'required'
			],
            [
				'field' => 'rasa',
				'label' => 'Rasa',
				'rules' => 'required'
			],
            [
				'field' => 'aroma',
				'label' => 'Aroma',
				'rules' => 'required'
			],
            [
				'field' => 'tekstur',
				'label' => 'Tekstur',
				'rules' => 'required'
			],
            [
				'field' => 'warna',
				'label' => 'Warna',
				'rules' => 'required'
			],
            [
				'field' => 'qc',
				'label' => 'Qc',
				// 'rules' => 'required'
			],
            [
				'field' => 'produksi',
				'label' => 'Produksi',
				'rules' => 'required'
			],
            [
				'field' => 'ket',
				'label' => 'Ket',
				// 'rules' => ''
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
		$nama_produk = $this->input->post('nama_produk');
		$kode_produksi = $this->input->post('kode_produksi');
		$t_raw = $this->input->post('t_raw');
		$jumlah_tray = $this->input->post('jumlah_tray');
		$t_ruang = $this->input->post('t_ruang');
		$t_produk = $this->input->post('t_produk');
		$t_produk1menit = $this->input->post('t_produk1menit');
		$waktu = $this->input->post('waktu');
		$keterangan = $this->input->post('keterangan');
		$jam_mulai = $this->input->post('jam_mulai');
		$jam_selesai = $this->input->post('jam_selesai');
		$kematangan = $this->input->post('kematangan');
		$rasa = $this->input->post('rasa');
		$aroma = $this->input->post('aroma');
		$tekstur = $this->input->post('tekstur');
		$warna = $this->input->post('warna');
		$qc = $this->input->post('qc');
		$produksi = $this->input->post('produksi');
		$ket = $this->input->post('ket');
		$catatan = $this->input->post('catatan');

		$data = array(
			'uuid' => $uuid,
			'date' => $this->input->post('date'),
            'shift' => $this->input->post('shift'),
            'nama_produk' => $this->input->post('nama_produk'),
            'kode_produksi' => $this->input->post('kode_produksi'),
            't_raw' => $this->input->post('t_raw'),
            'jumlah_tray' => $this->input->post('jumlah_tray'),
            't_ruang' => $this->input->post('t_ruang'),
            't_produk' => $this->input->post('t_produk'),
            't_produk1menit' => $this->input->post('t_produk1menit'),
            'waktu' => $this->input->post('waktu'),
            'keterangan' => $this->input->post('keterangan'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'kematangan' => $this->input->post('kematangan'),
            'rasa' => $this->input->post('rasa'),
            'aroma' => $this->input->post('aroma'),
            'tekstur' => $this->input->post('tekstur'),
            'warna' => $this->input->post('warna'),
            'qc' => $this->input->post('qc'),
            'produksi' => $this->input->post('produksi'),
            'ket' => $this->input->post('ket'),
            'catatan' => $this->input->post('catatan')
		);

		$this->db->insert('pem_masak_steamer', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}
    public function get_all(){
		$this->db->order_by('date', 'DESC');
        $query = $this->db->get('pem_masak_steamer');
        return $query->result();
    }

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('pem_masak_steamer', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('pem_masak_steamer');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('pem_masak_steamer');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
	public function get_by_date($tanggal)
    {
        $this->db->where('date', $tanggal);
        return $this->db->get('pem_masak_steamer')->result();
    }

}