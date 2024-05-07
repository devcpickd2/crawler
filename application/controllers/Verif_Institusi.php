<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verif_Institusi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('verif_institusi_model');
        $this->load->library('form_validation');
        $this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'verif_institusi' => $this->verif_institusi_model->get_all(),
			// 'tanggal' => date('Y-m-d'),
            'active_nav' => 'verif_institusi', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/verif_institusi');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->verif_institusi_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->verif_institusi_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Verifikasi Produk Institusi berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Verifikasi Produk Institusi");
            }
            redirect('verif_institusi');
        }

        $data = array(
            'verif_institusi' => $this->verif_institusi_model->get_all(),
            'active_nav' => 'verif_institusi', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/verif_institusi-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['verif_institusi'] = $this->verif_institusi_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('cooking/verif_institusi-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->verif_institusi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('cooking/verif_institusi-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
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

			$update = $this->verif_institusi_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Verifikasi Produk Institusi berhasil diupdate');
				redirect('verif_institusi');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data Verifikasi Institusi');
				redirect('verif_institusi/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->verif_institusi_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data verif_institusi berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data verif_institusi');
        }
        redirect('verif_institusi');
    }
	
	public function print_pdf()
	{
		$tanggal = $this->input->post('tanggal');
		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$verif_institusi = $this->verif_institusi_model->get_by_date($tanggal);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Efa Isnawati');
		$pdf->SetTitle('Verifikasi Institusi');
		$pdf->AddPage();
		
		$pdf->SetFont('helvetica', '', 10);
		// $logo = base_url('assets\img\cpi-logo.png');
		// $pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'VERIFIKASI Institusi', 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('helvetica', 11); 
		$pdf->Cell(0, 10, 'Tanggal: ' . $tanggal, 0, 1, 'L');
		if (!empty($verif_institusi)) {
			$pdf->Cell(0, 10, 'Shift: ' . $verif_institusi[0]->shift, 0, 1, 'L');
		}

		$pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B');
        $pdf->Cell(10, 20, 'NO', 1, 0, 'C', 1);
        $pdf->Cell(60, 20, 'NAMA Institusi', 1, 0, 'C', 1);
        $pdf->Cell(50, 20, 'KODE PRODUKSI', 1, 0, 'C', 1);
        $pdf->Cell(50, 20, 'SENSORI', 1, 0, 'C', 1);
        $pdf->Cell(60, 20, 'TINDAKAN KOREKSI', 1, 1, 'C', 1); // Changed last parameter to 1

        $pdf->SetFont('helvetica', '');
        $row = 1;
        foreach ($verif_institusi as $row_data) {
            $pdf->Cell(10, 10, $row++, 1, 0, 'C');
            $pdf->Cell(60, 10, $row_data->nama_institusi, 1, 0, 'C');
            $pdf->Cell(50, 10, $row_data->kode_produksi, 1, 0, 'C'); // Adjusted width
            $pdf->Cell(50, 10, $row_data->sensori, 1, 0, 'C'); // Adjusted width
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

		$pdf->Output('Verifikasi Institusi' . $tanggal . '.pdf', 'I');
	}

}
?>
