<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Sanitasi_model extends CI_Model {
    
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
                'field' => 'waktu',
                'label' => 'waktu',
                'rules' => 'required'
            ],
            [
                'field' => 'area',
                'label' => 'area',
                'rules' => 'required'
            ],
            [
                'field' => 'lokasi',
                'label' => 'lokasi',
                // 'rules' => 'required'
            ],
            [
                'field' => 'kondisi[]',
                'label' => 'kondisi',
                'rules' => 'required'
            ],
            [
                'field' => 'masalah[]',
                'label' => 'masalah',
                'rules' => 'required'
            ],
            [
                'field' => 'tindakan_koreksi[]',
                'label' => 'tindakan_koreksi',
                'rules' => 'required'
            ],
            
        ];
    }

    public function insert()
    {
        $uuid = Uuid::uuid4()->toString();
        $data['uuid'] = $uuid;
        $data['date'] = $this->input->post('date');
        $data['waktu'] = $this->input->post('waktu');
        $data['area'] = $this->input->post('area');
        $data['qc'] = $this->session->userdata('user_uuid');

        // Ambil informasi lokasi yang dipilih dari form
        $lokasiFields = $this->input->post('lokasi');

        // Pastikan $lokasiFields adalah array sebelum menggunakan implode
        if(is_array($lokasiFields)) {
            // Ubah array lokasi menjadi string atau JSON, tergantung pada kebutuhan aplikasi Anda
            $lokasi = implode(', ', $lokasiFields);
            // $lokasi = json_encode($lokasiFields);
        } else {
            $lokasi = ''; 
        }

        $data['lokasi'] = $lokasi;

        // Buat array kosong untuk kondisi, masalah, dan tindakan koreksi
        $kondisi = [];
        $masalah = [];
        $tindakan_koreksi = [];

        // Ambil semua nilai yang dikirimkan dalam bentuk array
        $kondisi_input = $this->input->post('kondisi');
        $masalah_input = $this->input->post('masalah');
        $tindakan_koreksi_input = $this->input->post('tindakan_koreksi');

        // Loop melalui semua nilai dan tambahkan ke dalam array sesuai dengan indexnya
        foreach ($kondisi_input as $index => $value) {
            $kondisi[$index] = $value;
        }

        foreach ($masalah_input as $index => $value) {
            $masalah[$index] = $value;
        }

        foreach ($tindakan_koreksi_input as $index => $value) {
            $tindakan_koreksi[$index] = $value;
        }

        // Ubah array menjadi JSON sebelum disimpan ke dalam database
        $data['kondisi'] = json_encode($kondisi);
        $data['masalah'] = json_encode($masalah);
        $data['tindakan_koreksi'] = json_encode($tindakan_koreksi);

        $this->db->insert('sanitasi_ruangan', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_all(){
        $this->db->select('sanitasi_ruangan.*, pegawai.nama as nama_pegawai');
        $this->db->join('pegawai', 'pegawai.uuid = sanitasi_ruangan.qc', 'left');
        $this->db->order_by('sanitasi_ruangan.created_at', 'DESC');
        $query = $this->db->get('sanitasi_ruangan');
        return $query->result();
    }

    public function update($uuid, $data)
    {
        $this->db->where('uuid', $uuid);
        $this->db->update('sanitasi_ruangan', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_by_uuid($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('sanitasi_ruangan');
        return $query->row();
    }

    public function delete($uuid)
    {
        $this->db->where('uuid', $uuid);
        $this->db->delete('sanitasi_ruangan');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_by_date_and_shift($tanggal, $shift)
    {
        $this->db->where('date', $tanggal)->where('shift', $shift)->order_by('date', 'asc');
        return $this->db->get('sanitasi_ruangan')->result();
    }
	public function get_by_date($tanggal)
    {
        $this->db->where('date', $tanggal);
        $this->db->select('sanitasi_ruangan.*, pegawai.nama as nama_pegawai');
        $this->db->join('pegawai', 'pegawai.uuid = sanitasi_ruangan.qc', 'left');
        $query = $this->db->get('sanitasi_ruangan');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
}
