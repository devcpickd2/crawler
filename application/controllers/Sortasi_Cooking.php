<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sortasi_Cooking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sortasi_cooking_model');
        $this->load->library('form_validation');
        $this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'sortasi_cooking' => $this->sortasi_cooking_model->get_all(),
            'active_nav' => 'sortasi_cooking', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/sortasi_cooking');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->sortasi_cooking_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->sortasi_cooking_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Sortasi Bahan Baku Yang Tidak Sesuai berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Sortasi Bahan Baku Yang Tidak Sesuai");
            }
            redirect('sortasi_cooking');
        }

        $data = array(
            'sortasi_cooking' => $this->sortasi_cooking_model->get_all(),
            'active_nav' => 'sortasi_cooking', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('cooking/sortasi_cooking-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['sortasi_cooking'] = $this->sortasi_cooking_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('cooking/sortasi_cooking-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->sortasi_cooking_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('cooking/sortasi_cooking-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
				'date' => $this->input->post('date'),
				'shift' => $this->input->post('shift'),
				'nama_bahan' => $this->input->post('nama_bahan'),
				'kode_produksi' => $this->input->post('kode_produksi'),
				'jumlah_bahan_sebelum' => $this->input->post('jumlah_bahan_sebelum'),
				'sesuai' => $this->input->post('sesuai'),
				'tidak_sesuai' => $this->input->post('tidak_sesuai'),
				'catatan' => $this->input->post('catatan')
			);

			$update = $this->sortasi_cooking_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data sortasi cooking berhasil diupdate');
				redirect('sortasi_cooking');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data sortasi cooking');
				redirect('sortasi_cooking/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->sortasi_cooking_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data sortasi_cooking berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data sortasi_cooking');
        }
        redirect('sortasi_cooking');
    }
	
	public function print_pdf()
	{
		$tanggal = $this->input->post('tanggal');
		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$sortasi_cooking = $this->sortasi_cooking_model->get_by_date($tanggal);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Efa Isnawati');
		$pdf->SetTitle('Verifikasi Premix');
		$pdf->AddPage();
		
		$pdf->SetFont('helvetica', '', 10);
		// $logo = base_url('assets\img\cpi-logo.png');
		// $pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'VERIFIKASI PREMIX', 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('helvetica', 11); 
		$pdf->Cell(0, 10, 'Tanggal: ' . $tanggal, 0, 1, 'L');
		if (!empty($sortasi_cooking)) {
			$pdf->Cell(0, 10, 'Shift: ' . $sortasi_cooking[0]->shift, 0, 1, 'L');
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
        foreach ($sortasi_cooking as $row_data) {
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

		$pdf->Output('Verifikasi Premix' . $tanggal . '.pdf', 'I');
	}

}
?>
