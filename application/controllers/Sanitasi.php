<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanitasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sanitasi_model');
        $this->load->library('form_validation');
        $this->load->model('login_model');
		if(!$this->login_model->current_user()){
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'sanitasi' => $this->sanitasi_model->get_all(),
            'active_nav' => 'sanitasi', 
        );

        $this->load->view('partials/head', $data);
        $this->load->view('sanitasi/sanitasi');
        $this->load->view('partials/footer');
    }
    
    public function tambah()
    {
        $rules = $this->sanitasi_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $insert = $this->sanitasi_model->insert();
            if ($insert) {
                $this->session->set_flashdata('success_msg', "Data Sanitasi Kebersihan ruangan berhasil disimpan");
            } else {
                $this->session->set_flashdata('error_msg', "Gagal menyimpan data Sanitasi Kebersihan ruangan");
            }
            redirect('sanitasi');
        }

        $data = array(
            'sanitasi' => $this->sanitasi_model->get_all(),
            'active_nav' => 'sanitasi',
        );
        // Get validation errors
            // $errors = validation_errors();

            // $data['errors'] = $errors;

            // var_dump($errors);
            // exit();

        $this->load->view('partials/head', $data);
        $this->load->view('sanitasi/sanitasi-tambah', $data);
        $this->load->view('partials/footer');
    }

	public function edit($uuid)
	{
		$data['sanitasi'] = $this->sanitasi_model->get_by_uuid($uuid);
//         var_dump($data);
//         exit()
// ;
		$this->load->view('partials/head', $data);
		$this->load->view('sanitasi/sanitasi-edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		// Form validation rules
		$rules = $this->sanitasi_model->rules();
		$this->form_validation->set_rules($rules);
        
		if ($this->form_validation->run() == FALSE) {

            // ini kalau error jadi nge bug wkkw
            // bagusnya mah di tampilin (opsional)
            
            // Get validation errors
            // $errors = validation_errors();

            // $data['errors'] = $errors;

            // var_dump($errors);
            // exit();

			$this->load->view('partials/head');
			$this->load->view('sanitasi/sanitasi-edit');
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

			$update = $this->sanitasi_model->update($uuid, $data);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data sanitasi berhasil diupdate');
				redirect('sanitasi');
			} else {
				$this->session->set_flashdata('error_msg', 'Gagal mengupdate data sanitasi');
				redirect('sanitasi/edit/' . $uuid);
			}
		}
	}

    public function hapus($uuid)
    {
        $delete = $this->sanitasi_model->delete($uuid);
        if ($delete) {
            $this->session->set_flashdata('success_msg', 'Data sanitasi berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_msg', 'Gagal menghapus data sanitasi');
        }
        redirect('sanitasi');
    }
	
    public function print_pdf()
    {
        $tanggal = $this->input->post('tanggal');
        $shift = $this->input->post('shift');
        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

        $sanitasi = $this->sanitasi_model->get_by_date($tanggal);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Efa Isnawati');
        $pdf->SetTitle('Sanitasi Kebersihaan Ruangan');
        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 5);
        $pdf->Cell(0, 10, 'PT CHAROEN POKPHAND INDONESIA - FOOD DIVISION', 0, 1, 'L');
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'KEBERSIHAAN RUANGAN', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 6, 'Tanggal: ' . $tanggal, 0, 1, 'L');

        $html = "
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: center;
                }
                th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                td {
                    font-size: 10px;
                }
            </style>
            <table>
                <tr>
                    <th rowspan='2'>NO</th>
                    <th rowspan='2'>Waktu Periksa</th>
                    <th rowspan='2'>Area</th>
                    <th colspan='2'>Kondisi</th>
                    <th rowspan='2'>Masalah</th>
                    <th rowspan='2'>Tindakan Koreksi</th>
                    <th rowspan='2'>Paraf</th>
                </tr>
        ";

        $row_number = 1; // Inisialisasi nomor urut di luar loop
        foreach ($sanitasi as $data) {
            $html .= "
                <tr>
                    <td>{$row_number}</td>
                    <td>{$data->waktu}</td>
                    <td><b>{$data->area}</b></td>
                    <td colspan='2'></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            ";

            $kondisi = $data->kondisi;
            $masalah = $data->masalah;
            $tindakan_koreksi = $data->tindakan_koreksi;

            $array_data_kondisi = json_decode($kondisi, true);
            $array_data_masalah = json_decode($masalah, true);
            $array_data_tindakan_koreksi = json_decode($tindakan_koreksi, true);

            foreach ($array_data_kondisi as $kondisi => $status) {
                $html .= "
                    <tr>
                        <td></td>
                        <td>{$data->date}</td>
                        <td>{$kondisi}</td>
                        <td colspan='2'>";
                if ($status == "0") {
                    $html .= "Oke";
                } else {
                    $html .= "Tidak";
                }
                $html .= "</td>
                        <td>{$array_data_masalah[$kondisi]}</td>
                        <td>{$array_data_tindakan_koreksi[$kondisi]}</td>
                        <td>{$data->nama_pegawai}</td>
                    </tr>
                ";
            }

            $row_number++;
        }

        $html .= "</table>";
        $pdf->writeHTML($html, true, false, false, false, '');

        $lebar1 = 175;
        $lebar2 = 0; 

        $pdf->Cell($lebar1 - $lebar2, 10, '', 0, 0); 
        $pdf->Cell($lebar2, 0, 'QR 01/02', 0, 1, 'L');

        $pdf->SetFont('helvetica', '', 5);
        $pdf->Cell(0, 3, 'Ket :', 0, 1, 'L');
        $pdf->Cell(0, 3, '1 : Berdebu', 0, 1, 'L');
        $pdf->Cell(0, 3, '2 : Basah', 0, 1, 'L');
        $pdf->Cell(0, 3, '3 : Pecah/Retak', 0, 1, 'L');
        $pdf->Cell(0, 3, '4 : Sisa Produk seperti lemak, daging, potongan plastik', 0, 1, 'L');
        $pdf->Cell(0, 3, '5 : Noda seperti tinta, karat, kerak', 0, 1, 'L');
        $pdf->Cell(0, 3, '6 : Pertumbuhan mikrooranisme, seperti jamur dan bau busuk', 0, 1, 'L');

        $pdf->Cell(0, 6, 'Catatan :');
        $pdf->Ln(); 
        $pdf->SetFont('helvetica', '', 10);

        $pdf->Cell(55, 10, 'Diperiksa oleh_______________', 0, 0, 'R');
        $pdf->Cell(130, 10, 'Disetujui oleh_______________', 0, 0, 'R');

        $pdf->Output('Sanitasi Kebersihaan Ruangan' . $tanggal . '.pdf', 'I');
    }


}
?>
