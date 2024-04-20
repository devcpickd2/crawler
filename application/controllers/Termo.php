<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('termo_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'termo' => $this->termo_model->get_all(),
			// 'tanggal' => date('Y-m-d'),
            'active_nav' => 'termo', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/termo');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->termo_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->termo_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Peneraan Termo berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Peneraan Termo");
            }
            redirect('termo');
        }

        $data = array(
            'termo' => $this->termo_model->get_all(),
            'active_nav' => 'termo', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/termo-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['termo'] = $this->termo_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('cooking/termo-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->termo_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('cooking/termo-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
				'date' => $this->input->post('date'),
				'shift' => $this->input->post('shift'),
				'kode_termo' => $this->input->post('kode_termo'),
				'pukul' => $this->input->post('pukul'),
				'hasil_tera' => $this->input->post('hasil_tera'),
				'tindakan' => $this->input->post('tindakan'),
				'catatan' => $this->input->post('catatan')
			);

			$update = $this->termo_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data peneraan termo berhasil diupdate');
				redirect('termo');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data peneraan termo');
				redirect('termo/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->termo_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data peneraan termo berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data peneraan termo');
        }
        redirect('termo');
    }
	// Code ini ngambil per UUID NYA YA
	// public function print_pdf($uuid)
	// {
	// 	require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

	// 	$termo = $this->termo_model->get_by_uuid($uuid);

	// 	$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

	// 	$pdf->setPrintHeader(false);

	// 	$pdf->SetCreator(PDF_CREATOR);
	// 	$pdf->SetAuthor('PT CHAROEN POKPHAND INDONESIA - FOOD VISION');
	// 	$pdf->SetTitle('Peneraan Termometer');

	// 	$pdf->AddPage();

	// 	$pdf->SetFont('helvetica', '', 10);

    //     $pdf->SetLineStyle(array('width' => 0));

	// 	$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD VISION', 0, 1, 'C');
	// 	$pdf->Cell(0, 10, 'Peneraan Termometer', 0, 1, 'C');
	// 	$pdf->Ln();

	// 	$pdf->Cell(0, 10, 'Tanggal: ' . $termo->date, 0, 1, 'L');
	// 	$pdf->Cell(0, 10, 'Shift: ' . $termo->shift, 0, 1, 'L');
	// 	$pdf->Ln();

	// 	// $header = array('NO', 'KODE TERMOMETER/AREA', 'STANDAR', 'PENERAAN', 'TINDAKAN KOREKSI', 'PUKUL', 'HASIL TERA');
	// 	$data = array(
	// 		array('1', $termo->kode_termo, '(0,0 C)', '', $termo->tindakan, $termo->pukul, $termo->hasil_tera),
	// 	);

	// 	// Set table header
	// 	$pdf->SetFillColor(255, 255, 255);
	// 	$pdf->SetFont('helvetica', 'B');
	// 	$pdf->Cell(10, 20, 'NO', 1, 0, 'C', 1);
	// 	$pdf->Cell(60, 20, 'KODE TERMOMETER/AREA', 1, 0, 'C', 1);
	// 	$pdf->Cell(30, 20, 'STANDAR', 1, 0, 'C', 1);
	// 	$pdf->Cell(30, 20, 'PENERAAN', 1, 0, 'C', 1);
	// 	$pdf->Cell(60, 20, 'TINDAKAN KOREKSI', 1, 0, 'C', 1);
	// 	$pdf->Cell(30, 20, 'PUKUL', 1, 0, 'C', 1);
	// 	$pdf->Cell(30, 20, 'HASIL TERA', 1, 1, 'C', 1);

	// 	// Set table data
	// 	$pdf->SetFont('helvetica', '');
	// 	foreach ($data as $row) {
	// 		$pdf->Cell(10, 10, $row[0], 1, 0, 'C');
	// 		$pdf->Cell(60, 10, $row[1], 1, 0, 'C');
	// 		$pdf->Cell(30, 10, $row[2], 1, 0, 'C');
	// 		$pdf->Cell(30, 10, $row[3], 1, 0, 'C');
	// 		$pdf->Cell(60, 10, $row[4], 1, 0, 'C');
	// 		$pdf->Cell(30, 10, $row[5], 1, 0, 'C');
	// 		$pdf->Cell(30, 10, $row[6], 1, 1, 'C');
	// 	}

	// 	// Keterangan
	// 	$pdf->Cell(0, 10, 'Keterangan:', 0, 1, 'L');
	// 	$pdf->Cell(0, 2, '- Tera termometer dilakukan setiap awal produksi', 0, 1, 'L');
	// 	$pdf->Cell(0, 2, '- Termometer ditera dengan memasukan sensor es(0 C)', 0, 1, 'L');
	// 	$pdf->Cell(0, 2, '- Jika ada selisih angka display suhu dengan suhu standar es, beri keterangan (+)', 0, 1, 'L');
	// 	$pdf->Cell(0, 2, '- atau(-) angka selisih (faktor koreksi)', 0, 1, 'L');
	// 	$pdf->Cell(0, 2, '- Jika faktor koreksi > 0,4 C, thermometer perlu perbaikan', 0, 1, 'L');
	// 	$pdf->Ln();

	// 	// Tanda tangan dan catatan
	// 	// $pdf->Cell(0, 10, 'Diperiksa Oleh: ________________', 0, 1, 'L');
	// 	// $pdf->Cell(0, 10, 'Disetujui Oleh: ________________', 0, 1, 'L');
	// 	// $pdf->Cell(0, 10, 'Catatan: __________________________________________________', 0, 1, 'L');
	// 	$pdf->Cell(55, 10, 'Diketahui oleh', 0, 0, 'R');
	// 	$pdf->Cell(55, 10, 'Disetujui oleh', 0, 0, 'R');
	// 	$pdf->Ln();

	// 	$pdf->Cell(55, 10, '.............................', 0, 0, 'R');
	// 	$pdf->Cell(55, 10, '.............................', 0, 0, 'R');
	// 	$pdf->Ln();

	// 	$pdf->Cell(55, 10, 'Qc Inspector', 0, 0, 'R');
	// 	$pdf->Cell(55, 10, 'SPV/Foreman/Lady Qc', 0, 0, 'R');
	// 	$pdf->Ln();

	// 	// Output PDF to browser
	// 	$pdf->Output('Peneraan_Termometer_' . $termo->date . '.pdf', 'I');
	// }

	//NGAMBIL PERTANGGAL
	public function print_pdf()
	{
		$tanggal = $this->input->post('tanggal');
		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$termo = $this->termo_model->get_by_date($tanggal);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Efa Isnawati');
		$pdf->SetTitle('Peneraan Termometer');
		$pdf->AddPage();
		
		$pdf->SetFont('helvetica', '', 10);
		$logo = base_url('assets\img\cpi-logo.png');
		$pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'PENERAAN TERMOMETER', 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('helvetica', 11); 
		$pdf->Cell(0, 10, 'Tanggal: ' . $tanggal, 0, 1, 'L');
		if (!empty($termo)) {
			$pdf->Cell(0, 10, 'Shift: ' . $termo[0]->shift, 0, 1, 'L');
		}

		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetFont('helvetica', 'B');
		$pdf->Cell(10, 20, 'NO', 1, 0, 'C', 1);
		$pdf->Cell(60, 20, 'KODE TERMOMETER/AREA', 1, 0, 'C', 1);
		$pdf->Cell(30, 20, 'STANDAR', 1, 0, 'C', 1);
		$pdf->Cell(30, 20, 'PUKUL', 1, 0, 'C', 1);
		$pdf->Cell(30, 20, 'HASIL TERA', 1, 0, 'C', 1);
		$pdf->Cell(60, 20, 'TINDAKAN KOREKSI', 1, 1, 'C', 1); 

		$pdf->SetFont('helvetica', '');
		$row = 1;
		foreach ($termo as $row_data) {
			$pdf->Cell(10, 10, $row++, 1, 0, 'C');
			$pdf->Cell(60, 10, $row_data->kode_termo, 1, 0, 'C');
			$pdf->Cell(30, 10, '(0,0 C)', 1, 0, 'C');
			$pdf->Cell(30, 10, $row_data->pukul, 1, 0, 'C');
			$pdf->Cell(30, 10, $row_data->hasil_tera, 1, 0, 'C');
			$pdf->Cell(60, 10, $row_data->tindakan, 1, 1, 'C');
		}

		$pdf->Cell(0, 10, 'Keterangan:', 0, 1, 'L');
		$pdf->Cell(0, 2, '- Tera termometer dilakukan setiap awal produksi', 0, 1, 'L');
		$pdf->Cell(0, 2, '- Termometer ditera dengan memasukan sensor es(0 C)', 0, 1, 'L');
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

		$pdf->Output('Peneraan_Termometer_' . $tanggal . '.pdf', 'I');
	}

}
?>
