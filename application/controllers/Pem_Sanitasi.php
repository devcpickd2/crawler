<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pem_Sanitasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pem_sanitasi_model');
        $this->load->library('form_validation');
        $this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'pem_sanitasi' => $this->pem_sanitasi_model->get_all(),
            'active_nav' => 'pem_sanitasi', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('sanitasi/pem_sanitasi');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->pem_sanitasi_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->pem_sanitasi_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Pemeriksaan Sanitasi berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Pemeriksaan Sanitasi");
            }
            redirect('pem_sanitasi');
        }

        $data = array(
            'pem_sanitasi' => $this->pem_sanitasi_model->get_all(),
            'active_nav' => 'pem_sanitasi', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('sanitasi/pem_sanitasi-tambah', $data);
        $this->load->view('partials/footer');
    }
	public function edit($uuid)
	{
		$data['pem_sanitasi'] = $this->pem_sanitasi_model->get_by_uuid($uuid);

		$this->load->view('partials/head', $data);
		$this->load->view('sanitasi/pem_sanitasi-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->pem_sanitasi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/head');
			$this->load->view('sanitasi/pem_sanitasi-edit');
			$this->load->view('partials/footer');
		} else {
			$uuid = $this->input->post('uuid');

			$data = array(
				'uuid' => $uuid,
                'date' => $this->input->post('date'),
                'shift' => $this->input->post('shift'),
                'pukul' => $this->input->post('pukul'),
                'foot_basin' => $this->input->post('foot_basin'),
                'hand_basin' => $this->input->post('hand_basin'),
                'keterangan' => $this->input->post('keterangan'),
                'tindakan_koreksi' => $this->input->post('tindakan_koreksi'),
                'produksi' => $this->input->post('produksi'),
                'catatan' => $this->input->post('catatan')
			);

			$update = $this->pem_sanitasi_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data pem_sanitasi berhasil diupdate');
				redirect('pem_sanitasi');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data pem_sanitasi');
				redirect('pem_sanitasi/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->pem_sanitasi_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data pem_sanitasi berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data pem_sanitasi');
        }
        redirect('pem_sanitasi');
    }
	
	public function print_pdf()
    {
        $tanggal = $this->input->post('tanggal');
        $shift = $this->input->post('shift');

        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

        $pem_sanitasi = $this->pem_sanitasi_model->get_by_date_and_shift($tanggal, $shift); 

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Efa Isnawati');
        $pdf->SetTitle('Pemeriksaan Sanitasi');
        $pdf->AddPage();

		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'PEMERIKSAAN SANITASI', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 10);

        $pdf->SetFont('helvetica', 10); 
        $pdf->Cell(0, 6, 'Tanggal: ' . $tanggal, 0, 1, 'L'); 
        if (!empty($pem_sanitasi)) {
            $pdf->Cell(0, 6, 'Shift: ' . $pem_sanitasi[0]->shift, 0, 1, 'L');
        }
        $pdf->SetFont('helvetica', '', 9);

        $html = '<table border="1">
                    <thead>
                    <tr style="text-align:center; width:100%">
                        <th>Pukul</th>
                        <th>Foot Basin</th>
                        <th>Hand Basin</th>
                        <th>Keterangan</th>
                        <th>Tindakan Koreksi</th>
                        <th>QC</th>
                        <th>Produksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align:center;">
                        <td>Standar</td>
                        <td>200 ppm</td>
                        <td>500 ppm</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';

        foreach ($pem_sanitasi as $data) {
            $html .= '<tr style="text-align:center;">
                        <td>' . $data->pukul . '</td>
                        <td>' . $data->foot_basin . '</td>
                        <td>' . $data->hand_basin . '</td>
                        <td>' . $data->keterangan . '</td>
                        <td>' . $data->tindakan_koreksi . '</td>
                        <td>' . $data->nama_pegawai . '</td>
                        <td>' . $data->produksi . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';
        $pdf->writeHTML($html, true, false, false, false, '');
        $lebar1 = 175;
        $lebar2 = 0; 

        $pdf->Cell($lebar1 - $lebar2, 10, '', 0, 0); 
        $pdf->Cell($lebar2, 0, 'QR 03/01', 0, 1, 'L');

        $pdf->Cell(0, 6, 'Catatan: ' . $data->catatan, 0, 1, 'L');
        $pdf->Ln(); 

        $pdf->Cell(55, 10, 'Diperiksa oleh_______________', 0, 0, 'R');
        $pdf->Cell(130, 10, 'Disetujui oleh_______________', 0, 0, 'R');

        $pdf->Output('Pemeriksaan Sanitasi.pdf', 'I');
    }

}
?>
