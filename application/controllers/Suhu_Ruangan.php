<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suhu_Ruangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('suhu_ruangan_model');
        $this->load->library('form_validation');
        $this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'suhu_ruangan' => $this->suhu_ruangan_model->get_all(),
			// 'tanggal' => date('Y-m-d'),
            'active_nav' => 'suhu_ruangan', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('suhu_ruangan/suhu_ruangan');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->suhu_ruangan_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->suhu_ruangan_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Suhu Ruangan berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Suhu Ruangan");
            }
            redirect('suhu_ruangan');
        }

        $data = array(
            'suhu_ruangan' => $this->suhu_ruangan_model->get_all(),
            'active_nav' => 'suhu_ruangan', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('suhu_ruangan/suhu_ruangan-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['suhu_ruangan'] = $this->suhu_ruangan_model->get_by_uuid($uuid);
//         var_dump($data);
//         exit()
// ;
		$this->load->view('partials/head', $data);
		$this->load->view('suhu_ruangan/suhu_ruangan-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->suhu_ruangan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('suhu_ruangan/suhu_ruangan-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
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
                'catatan' => $this->input->post('catatan')
			);

			$update = $this->suhu_ruangan_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data suhu_ruangan berhasil diupdate');
				redirect('suhu_ruangan');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data suhu_ruangan');
				redirect('suhu_ruangan/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->suhu_ruangan_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data suhu_ruangan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data suhu_ruangan');
        }
        redirect('suhu_ruangan');
    }
	
	public function print_pdf()
	{
		$tanggal = $this->input->post('tanggal');
        $shift = $this->input->post('shift');
		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		// $suhu_ruangan = $this->suhu_ruangan_model->get_by_date($tanggal); // ori
		$suhu_ruangan = $this->suhu_ruangan_model->get_by_date_and_shift($tanggal, $shift); 

        var_dump($suhu_ruangan);
        exit();

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Efa Isnawati');
		$pdf->SetTitle('Suhu Ruangan');
		$pdf->AddPage();
		
		$pdf->SetFont('helvetica', '', 10);
		// $logo = base_url('assets\img\cpi-logo.png');
		// $pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'Suhu Ruangan', 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('helvetica', 11); 
		$pdf->Cell(0, 10, 'Tanggal: ' . $tanggal, 0, 1, 'L');
		if (!empty($suhu_ruangan)) {
			$pdf->Cell(0, 10, 'Shift: ' . $suhu_ruangan[0]->shift, 0, 1, 'L');
		}

		$pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B');
        $pdf->Cell(10, 20, 'NO', 1, 0, 'C', 1);
        $pdf->Cell(60, 20, 'NAMA PREMIX', 1, 0, 'C', 1);
        $pdf->Cell(50, 20, 'KODE PRODUKSI', 1, 0, 'C', 1);
        $pdf->Cell(50, 20, 'SENSORI', 1, 0, 'C', 1);
        $pdf->Cell(60, 20, 'TINDAKAN KOREKSI', 1, 1, 'C', 1); // Changed last parameter to 1

        $pdf->SetFont('helvetica', '');
        $row = 1;
        foreach ($suhu_ruangan as $row_data) {
            $pdf->Cell(10, 10, $row++, 1, 0, 'C');
            $pdf->Cell(60, 10, $row_data->nama_premix, 1, 0, 'C');
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

		$pdf->Output('Suhu Ruangan' . $tanggal . '.pdf', 'I');
	}

}
?>
