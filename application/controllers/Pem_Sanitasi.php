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
                $this->session->set_flashdata('success_msg', "Data Verifikasi Premix berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Verifikasi Premix");
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

        $suhu_ruangan = $this->pem_sanitasi_model->get_by_date_and_shift($tanggal, $shift); 

        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Efa Isnawati');
        $pdf->SetTitle('Suhu Ruangan');
        $pdf->AddPage();

		$pdf->SetFont('helvetica', '', 5);
		$pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');;

        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'PEMERIKSAAN SUHU RUANGAN', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 10);

        $pdf->SetFont('helvetica', 10); 
        $pdf->Cell(0, 6, 'Tanggal: ' . $tanggal, 0, 1, 'L'); 
        if (!empty($suhu_ruangan)) {
            $pdf->Cell(0, 6, 'Shift: ' . $suhu_ruangan[0]->shift, 0, 1, 'L');
        }
        $pdf->SetFont('helvetica', '', 8);

        $html = '<table border="1">
                    <thead>
                    <tr>
                        <th colspan="20" style="text-align:center;">Ruangan &deg;Celcius</th>
                    </tr>
                    <tr style="text-align:center; width:100%">
                        <th>Pukul</th>
                        <th>Chill Room</th>
                        <th>Cold Storage 1</th>
                        <th>Cold Storage 2</th>
                        <th>Anteroom</th>
                        <th>T(&deg;C)</th>
                        <th>RH(%)</th>
                        <th>Prep Room</th>
                        <th>Cooking Room</th>
                        <th>Filling Room</th>
                        <th>Rice Room</th>
                        <th>Noodle Room</th>
                        <th>Topping Area</th>
                        <th>Packing(karton)</th>
                        <th>T(&deg;C)</th>
                        <th>RH(%)</th>
                        <th>Cold Storage FG</th>
                        <th>Keterangan</th>
                        <th>QC</th>
                        <th>Produksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align:center;">
                        <td>STD (&deg;C)</td>
                        <td>0 - 4</td>
                        <td style="font-family: DejaVu Sans;">-20≠2</td>
                        <td style="font-family: DejaVu Sans;">-20≠2</td>
                        <td>8 - 10</td>
                        <td>22 - 20</td>
                        <td> &lt; 75 </td>
                        <td>8 - 12</td>
                        <td>20 - 30</td>
                        <td>8 - 12</td>
                        <td>20 - 30</td>
                        <td>20 - 30</td>
                        <td>8 - 12</td>
                        <td>8 - 12</td>
                        <td>20 - 30</td>
                        <td> &lt; 75 </td>
                        <td style="font-family: DejaVu Sans;">-19≠1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';

        foreach ($suhu_ruangan as $data) {
            $html .= '<tr style="text-align:center;">
                        <td>' . $data->pukul . '</td>
                        <td>' . $data->chill_room . '</td>
                        <td>' . $data->cold_stor1 . '</td>
                        <td>' . $data->cold_stor2 . '</td>
                        <td>' . $data->anteroom . '</td>
                        <td>' . $data->sea_T . '</td>
                        <td>' . $data->sea_RH . '</td>
                        <td>' . $data->prep_room . '</td>
                        <td>' . $data->cooking_room . '</td>
                        <td>' . $data->filling_room . '</td>
                        <td>' . $data->rice_room . '</td>
                        <td>' . $data->noodle_room . '</td>
                        <td>' . $data->topping_area . '</td>
                        <td>' . $data->packing_karton . '</td>
                        <td>' . $data->dry_T . '</td>
                        <td>' . $data->dry_RH . '</td>
                        <td>' . $data->cold_fg . '</td>
                        <td>' . $data->keterangan . '</td>
                        <td>' . $data->nama_pegawai . '</td>
                        <td>' . $data->produksi . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';
        $pdf->writeHTML($html, true, false, false, false, '');
        $lebar1 = 260;
        $lebar2 = 0; 

        $pdf->Cell($lebar1 - $lebar2, 10, '', 0, 0); 
        $pdf->Cell($lebar2, 0, 'QR 02/03', 0, 1, 'L');

        $pdf->Cell(0, 6, 'Catatan: ' . $data->catatan, 0, 1, 'L');
        $pdf->Ln(); 

        $pdf->Cell(55, 10, 'Diperiksa oleh_______________', 0, 0, 'R');
        $lebar_halaman = 210;
        $lebar_sel = 55; 

        $pdf->Cell($lebar_halaman - $lebar_sel, 10, '', 0, 0); 
        $pdf->Cell($lebar_sel, 10, 'Disetujui oleh_______________', 0, 1, 'L');

        $pdf->Output('Suhu_Ruangan.pdf', 'I');
    }

}
?>
