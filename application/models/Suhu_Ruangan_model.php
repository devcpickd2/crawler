<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Suhu_Ruangan_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	public function rules(){
		return [
            [
                'field' => 'date',
                'label' => 'Tanggal',
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
                'field' => 'chill_room',
                'label' => 'Chill Room',
                'rules' => 'required'
            ],
            [
                'field' => 'cold_stor1',
                'label' => 'Cold Storage 1',
                'rules' => 'required'
            ],
            [
                'field' => 'cold_stor2',
                'label' => 'Cold Storage 2',
                'rules' => 'required'
            ],
            [
                'field' => 'anteroom',
                'label' => 'Anteroom',
                'rules' => 'required'
            ],
            [
                'field' => 'sea_T',
                'label' => 'Seasoning T',
                'rules' => 'required'
            ],
            [
                'field' => 'sea_RH',
                'label' => 'Seasoning RH',
                'rules' => 'required'
            ],
            [
                'field' => 'prep_room',
                'label' => 'Prep. Room',
                'rules' => 'required'
            ],
            [
                'field' => 'cooking_room',
                'label' => 'Cooking Room',
                'rules' => 'required'
            ],
            [
                'field' => 'filling_room',
                'label' => 'Filling Room',
                'rules' => 'required'
            ],
            [
                'field' => 'rice_room',
                'label' => 'rice Room',
                'rules' => 'required'
            ],
            [
                'field' => 'noodle_room',
                'label' => 'noodle Room',
                'rules' => 'required'
            ],
            [
                'field' => 'topping_area',
                'label' => 'topping area',
                'rules' => 'required'
            ],
            [
                'field' => 'packing_karton',
                'label' => '',
                'rules' => 'required'
            ],
            [
                'field' => 'dry_T',
                'label' => '',
                'rules' => 'required'
            ],
            [
                'field' => 'dry_RH',
                'label' => '',
                'rules' => 'required'
            ],
            [
                'field' => 'cold_fg',
                'label' => '',
                'rules' => 'required'
            ],
            [
                'field' => 'keterangan',
                'label' => '',
                'rules' => ''
            ],
            [
                'field' => 'produksi',
                'label' => '',
                'rules' => 'required'
            ],
            [
                'field' => 'catatan',
                'label' => '',
                'rules' => ''
            ],
        ];
    }

    public function insert()
    {
        $uuid = Uuid::uuid4()->toString();

        // ini ga berpengaruh sebenernya
        $date = $this->input->post('date');
        $shift = $this->input->post('shift');
        $pukul = $this->input->post('pukul');
        $chill_room = $this->input->post('chill_room');
        $cold_stor1 = $this->input->post('cold_stor1');
        $cold_stor2 = $this->input->post('cold_stor2');
        $anteroom = $this->input->post('anteroom');
        $sea_T = $this->input->post('sea_T');
        $sea_RH = $this->input->post('sea_RH');
        $prep_room = $this->input->post('prep_room');
        $cooking_room = $this->input->post('cooking_room');
        $filling_room = $this->input->post('filling_room');
        $rice_room = $this->input->post('rice_room');
        $noodle_room = $this->input->post('noodle_room');
        $topping_area = $this->input->post('topping_area');
        $packing_karton = $this->input->post('packing_karton');
        $dry_T = $this->input->post('dry_T');
        $dry_RH = $this->input->post('dry_RH');
        $cold_fg = $this->input->post('cold_fg');
        $keterangan = $this->input->post('keterangan');
        $produksi = $this->input->post('produksi');
        $catatan = $this->input->post('catatan');

        $data = array(
            'uuid' => $uuid,
            'date' => $this->input->post('date'),
            'shift' => $this->input->post('shift'),
            'pukul' => $this->input->post('pukul'),
            'chill_room' => $this->input->post('chill_room'),
            'cold_stor1' => $this->input->post('cold_stor1'),
            'cold_stor2' => $this->input->post('cold_stor2'),
            'anteroom' => $this->input->post('anteroom'),
            'sea_T' => $this->input->post('sea_T'),
            'sea_RH' => $this->input->post('sea_RH'),
            'prep_room' => $this->input->post('prep_room'),
            'cooking_room' => $this->input->post('cooking_room'),
            'filling_room' => $this->input->post('filling_room'),
            'rice_room' => $this->input->post('rice_room'),
            'noodle_room' => $this->input->post('noodle_room'),
            'topping_area' => $this->input->post('topping_area'),
            'packing_karton' => $this->input->post('packing_karton'),
            'dry_T' => $this->input->post('dry_T'),
            'dry_RH' => $this->input->post('dry_RH'),
            'cold_fg' => $this->input->post('cold_fg'),
            'keterangan' => $this->input->post('keterangan'),
            'produksi' => $this->input->post('produksi'),
            'qc' => $this->session->userdata('user_uuid'),
            'catatan' => $this->input->post('catatan')
        );
        $this->db->insert('suhu_ruangan', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_all(){
        // $this->db->order_by('created_at', 'DESC');
        // $query = $this->db->get('suhu_ruangan');
        // return $query->result();

        $this->db->select('suhu_ruangan.*, pegawai.nama as nama_pegawai');
        $this->db->join('pegawai', 'pegawai.uuid = suhu_ruangan.qc', 'left');
        $this->db->order_by('suhu_ruangan.created_at', 'DESC');
        $query = $this->db->get('suhu_ruangan');
        return $query->result();
    }

	public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('suhu_ruangan', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('suhu_ruangan');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('suhu_ruangan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    // Yang ini ngambil pertanggal doang ya
	// public function get_by_date($tanggal)
    // {
	// 	$this->db->where('date', $tanggal);
    //     return $this->db->get('suhu_ruangan')->result();
	// } ori
	public function get_by_date_and_shift($tanggal, $shift)
    {
        $this->db->select('suhu_ruangan.*, pegawai.nama as nama_pegawai');
        $this->db->join('pegawai', 'pegawai.uuid = suhu_ruangan.qc', 'left');
        $this->db->where('suhu_ruangan.date', $tanggal)->where('suhu_ruangan.shift', $shift)->order_by('suhu_ruangan.date', 'asc');
        $query = $this->db->get('suhu_ruangan');
        return $query->result();
    }

}