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
class Core extends CI_Controller
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
        
        $this->load->view('partials/head');
        $this->load->view('home/home');
        $this->load->view('partials/footer');
    }

    public function fetch_youtube_data()
    {
        header('Content-Type: application/json');

        $filters = $this->input->get(); // Retrieve filter inputs from AJAX request
        if (!empty($filters)) {
            $data = $this->youtube_data_model->get_filtered($filters);
        } else {
            $data = $this->youtube_data_model->get_all();
        }

        echo json_encode($data); // Respond with JSON data
    }
    

}


