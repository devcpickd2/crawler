<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
class Negative_Mentions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('youtube_data_model');
        if (!$this->login_model->current_user()) {
            redirect('login');
        }
    }

    public function index()
    {
        // Cek data baru yang mengandung kata negatif
        $new_negative_mentions = $this->youtube_data_model->check_new_negative_mentions();

        // Filter data baru dengan tanggal hari ini
        $today_mentions = array_filter($new_negative_mentions, function ($mention) {
            return date('Y-m-d', strtotime($mention->updated_at)) === date('Y-m-d');
        });

        // Jika ada data baru, set flag untuk menampilkan notifikasi
        $data['show_notification'] = !empty($today_mentions);
        $data['negative_mentions'] = $this->youtube_data_model->get_all_negative_mentions();

        // Kirim data baru dengan kata negatif ke view (untuk ditampilkan di notifikasi)
        $data['new_mentions'] = $today_mentions;

        $this->load->view('partials/head');
        $this->load->view('home/negative_mentions', $data);
        $this->load->view('partials/footer');
    }
}



