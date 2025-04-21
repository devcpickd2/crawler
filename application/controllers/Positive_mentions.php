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
class Positive_Mentions extends CI_Controller
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
		$data['positive_mentions'] = $this->youtube_data_model->get_all_positive_mentions();
		$this->load->view('partials/head');
		$this->load->view('home/positive_mentions',$data);
		$this->load->view('partials/footer');
	}

}


