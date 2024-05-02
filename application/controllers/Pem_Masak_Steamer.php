<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pem_Masak_Steamer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pem_masak_steamer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'pem_masak_steamer' => $this->pem_masak_steamer_model->get_all(),
            'active_nav' => 'pem_masak_steamer', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/pem_masak_steamer');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->pem_masak_steamer_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->pem_masak_steamer_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Pemeriksaan Pemasakan Dengan Streamer berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Pemeriksaan Pemasakan Dengan Streamer");
            }
            redirect('pem_masak_steamer');
        }

        $data = array(
            'pem_masak_steamer' => $this->pem_masak_steamer_model->get_all(),
            'active_nav' => 'pem_masak_steamer', 
        );
        // var_dump($data);
        // exit();

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/pem_masak_steamer-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['pem_masak_steamer'] = $this->pem_masak_steamer_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('cooking/pem_masak_steamer-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->pem_masak_steamer_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('cooking/pem_masak_steamer-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
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

			$update = $this->pem_masak_steamer_model->update($uuid, $data);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data sortasi cooking berhasil diupdate');
				redirect('pem_masak_steamer');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data sortasi cooking');
				redirect('pem_masak_steamer/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->pem_masak_steamer_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data pem_masak_steamer berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data pem_masak_steamer');
        }
        redirect('pem_masak_steamer');
    }
	
	public function print_pdf()
	{
		$tanggal = $this->input->post('tanggal');
		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pem_masak_steamer = $this->pem_masak_steamer_model->get_by_date($tanggal);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Efa Isnawati');
		$pdf->SetTitle('Pemeriksaan Pemaskan Dengan Streamer');
		$pdf->AddPage();
		
		$pdf->SetFont('helvetica', '', 10);
		// $logo = base_url('assets\img\cpi-logo.png');
		// $pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'PEMERIKSAAN PEMASAKAN DENGAN STEAMER', 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('helvetica', 11); 
		$pdf->Cell(0, 10, 'Tanggal: ' . $tanggal, 0, 1, 'L');
		if (!empty($pem_masak_steamer)) {
			$pdf->Cell(0, 10, 'Shift: ' . $pem_masak_steamer[0]->shift, 0, 1, 'L');
		}

		$pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B');
        $pdf->Cell(10, 20, 'NO', 1, 0, 'C', 1);
        $pdf->Cell(60, 20, 'NAMA PREMIX', 1, 0, 'C', 1);
        $pdf->Cell(50, 20, 'KODE PRODUKSI', 1, 0, 'C', 1);
        $pdf->Cell(50, 20, 'SENSORI', 1, 0, 'C', 1);
        $pdf->Cell(60, 20, 'TINDAKAN KOREKSI', 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', '');
        $row = 1;
        foreach ($pem_masak_steamer as $row_data) {
            $pdf->Cell(10, 10, $row++, 1, 0, 'C');
            $pdf->Cell(60, 10, $row_data->nama_premix, 1, 0, 'C');
            $pdf->Cell(50, 10, $row_data->kode_produksi, 1, 0, 'C'); 
            $pdf->Cell(50, 10, $row_data->sensori, 1, 0, 'C');
            $pdf->Cell(60, 10, $row_data->tindakan_koreksi, 1, 1, 'C');
        }

        $pdf->Cell(0, 10, 'Keterangan:', 0, 1, 'L');
        $pdf->Cell(0, 2, '- Sensori : Tidak ada yang mengumpal, warna dan aroma normal', 0, 1, 'L');
        $pdf->Cell(0, 2, '- Tindakan koreksi diisi jika sensori tidak sesuai atau terdapat kontaminasi benda asing', 0, 1, 'L');
        $pdf->Ln();

        $pdf->Cell(55, 10, 'Diperiksa oleh', 0, 0, 'R');
        $pdf->Cell(55, 10, 'Diketahui oleh', 0, 0, 'R');
        $pdf->Cell(55, 10, 'Disetujui oleh', 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(55, 10, '.............................', 0, 0, 'R');
        $pdf->Cell(55, 10, '.............................', 0, 0, 'R');
        $pdf->Cell(55, 10, '.............................', 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(55, 10, 'QC', 0, 0, 'R');
        $pdf->Cell(55, 10, 'Produksi', 0, 0, 'R');
        $pdf->Cell(55, 10, 'SPV QC', 0, 0, 'R');
        $pdf->Ln();

		$pdf->Output('Pemeriksaan Pemaskan Dengan Streamer' . $tanggal . '.pdf', 'I');
	}

}
?>
