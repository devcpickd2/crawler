<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timbangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('timbangan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'timbangan' => $this->timbangan_model->get_all(),
			// 'tanggal' => date('Y-m-d'),
            'active_nav' => 'timbangan', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/timbangan');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->timbangan_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->timbangan_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Peneraan timbangan berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Peneraan timbangan");
            }
            redirect('timbangan');
        }

        $data = array(
            'timbangan' => $this->timbangan_model->get_all(),
            'active_nav' => 'timbangan', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/timbangan-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['timbangan'] = $this->timbangan_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('cooking/timbangan-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->timbangan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('cooking/timbangan-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
				'date' => $this->input->post('date'),
				'shift' => $this->input->post('shift'),
				'kode_timbangan' => $this->input->post('kode_timbangan'),
				'pukul' => $this->input->post('pukul'),
				'hasil_tera' => $this->input->post('hasil_tera'),
				'tindakan' => $this->input->post('tindakan'),
				'catatan' => $this->input->post('catatan')
			);

			$update = $this->timbangan_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data peneraan Timbangan berhasil diupdate');
				redirect('timbangan');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data peneraan Timbangan');
				redirect('timbangan/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->timbangan_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data peneraan timbangan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data peneraan timbangan');
        }
        redirect('timbangan');
    }
    public function print_pdf()
	{
		$tanggal = $this->input->post('tanggal');
		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$timbangan = $this->timbangan_model->get_by_date($tanggal);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Efa Isnawati');
		$pdf->SetTitle('Peneraan Timbangan');
		$pdf->AddPage();
		
		$pdf->SetFont('helvetica', '', 10);
		// $logo = base_url('assets\img\cpi-logo.png');
		$pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'PENERAAN TIMBANGAN', 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('helvetica', 11); 
		$pdf->Cell(0, 10, 'Tanggal: ' . $tanggal, 0, 1, 'L');
		if (!empty($timbangan)) {
			$pdf->Cell(0, 10, 'Shift: ' . $timbangan[0]->shift, 0, 1, 'L');
		}

		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetFont('helvetica', 'B');
		$pdf->Cell(10, 20, 'NO', 1, 0, 'C', 1);
		$pdf->Cell(60, 20, 'KODE TIMBANGAN', 1, 0, 'C', 1);
		$pdf->Cell(30, 20, 'STANDAR', 1, 0, 'C', 1);
		$pdf->Cell(30, 20, 'PUKUL', 1, 0, 'C', 1);
		$pdf->Cell(30, 20, 'HASIL TERA', 1, 0, 'C', 1);
		$pdf->Cell(60, 20, 'TINDAKAN KOREKSI', 1, 1, 'C', 1); 

		$pdf->SetFont('helvetica', '');
		$row = 1;
		foreach ($timbangan as $row_data) {
			$pdf->Cell(10, 10, $row++, 1, 0, 'C');
			$pdf->Cell(60, 10, $row_data->kode_timbangan, 1, 0, 'C');
			$pdf->Cell(30, 10, '(0,0 C)', 1, 0, 'C');
			$pdf->Cell(30, 10, $row_data->pukul, 1, 0, 'C');
			$pdf->Cell(30, 10, $row_data->hasil_tera, 1, 0, 'C');
			$pdf->Cell(60, 10, $row_data->tindakan, 1, 1, 'C');
		}

		$pdf->Cell(0, 10, 'Keterangan:', 0, 1, 'L');
		$pdf->Cell(0, 2, '- Tera timbangan dilakukan setiap awal produksi', 0, 1, 'L');
		$pdf->Cell(0, 2, '- Timbangan ditera dengan memasukan sensor es(0 C)', 0, 1, 'L');
		$pdf->Cell(0, 2, '- Jika ada selisih angka display suhu dengan suhu standar es, beri keterangan (+)', 0, 1, 'L');
		$pdf->Cell(0, 2, '- atau(-) angka selisih (faktor koreksi)', 0, 1, 'L');
		$pdf->Cell(0, 2, '- Jika faktor koreksi > 0,4 C, thermometer perlu perbaikan', 0, 1, 'L');
		$pdf->Ln();

		$pdf->Cell(55, 10, 'Diketahui oleh', 0, 0, 'R');
		$pdf->Cell(55, 10, 'Disetujui oleh', 0, 0, 'R');
		$pdf->Ln();
		$pdf->Cell(55, 10, '.............................', 0, 0, 'R');
		$pdf->Cell(55, 10, '.............................', 0, 0, 'R');
		$pdf->Ln();
		$pdf->Cell(55, 10, 'Qc Inspector', 0, 0, 'R');
		$pdf->Cell(55, 10, 'SPV Qc', 0, 0, 'R');
		$pdf->Ln();

		$pdf->Output('Peneraan_timbanganmeter_' . $tanggal . '.pdf', 'I');
	}
}    