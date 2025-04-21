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
class Home extends CI_Controller
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
		$excluded_keywords = [
			"kanzler nugget",
			"kanzler sosis",
			"kanzler cordon bleu",
			"kanzler singles",
			"kimbo sosis",
			"so good crispy chicken nu",
			"so nice sosis premium",
			"so nice sosis siap makan",
			"belfoods",
			"sunny gold nugget",
			"salam nugget ayam",
			"salam sosis ayam",
			"sasa tepung bumbu",
			"bumbu racik indofood",
			"sosis gaga",
			"kobe bumbu",
			"kobe tepung",
			"laukita"
		];

		// Fetch sorted and filtered data for like_count
		$data['youtube_data'] = $this->get_filtered_data_like_count();
		$data['total_positive_mentions_count'] = $this->youtube_data_model->get_total_positive_mentions();
		$data['total_negative_mentions_count'] = $this->youtube_data_model->get_total_negative_mentions();
		// Retrieve other necessary data
		$data['keyword_counts'] = $this->youtube_data_model->get_keyword_counts();
		$data['pt_keywords'] = $this->youtube_data_model->get_unique_keywords_exclude();
		$data['competitor_keywords'] = $this->youtube_data_model->get_keywords_to_include($excluded_keywords);
		$data['positive_mentions'] = $this->youtube_data_model->get_positive_mentions_by_keywords();
		$data['negative_mentions'] = $this->youtube_data_model->get_negative_mentions_by_keywords();
		$data['total_likes'] = $this->youtube_data_model->get_total_likes_by_keywords();
		$data['competitor_keyword_mentions'] = $this->youtube_data_model->get_competitor_mentions($excluded_keywords);
		$data['competitor_positive_mentions'] = $this->youtube_data_model->get_positive_mentions_by_keywords();
		$data['competitor_negative_mentions'] = $this->youtube_data_model->get_negative_mentions_by_keywords();
		$data['keyword_analyze'] = $this->youtube_data_model->get_unique_keywords();
		$data['optimized_tags'] = $this->youtube_data_model->getOptimizedTags();
		$data['top_titles'] = $this->youtube_data_model->getTop5UniqueTitles();

		$data['enak'] = $this->youtube_data_model->get_mentions_by_enak();
		$data['tidak_enak'] = $this->youtube_data_model->get_negative_mentions_by_enak();
		$data['lezat'] = $this->youtube_data_model->get_mentions_by_lezat();
		$data['tidak_lezat'] = $this->youtube_data_model->get_negative_mentions_by_lezat();
		$data['menarik'] = $this->youtube_data_model->get_mentions_by_menarik();
		$data['tidak_menarik'] = $this->youtube_data_model->get_negative_mentions_by_menarik();
		$data['kenyal'] = $this->youtube_data_model->get_mentions_by_kenyal();
		$data['tidak_kenyal'] = $this->youtube_data_model->get_negative_mentions_by_kenyal();
		$data['hemat'] = $this->youtube_data_model->get_mentions_by_hemat();
		$data['tidak_hemat'] = $this->youtube_data_model->get_negative_mentions_by_hemat();
		$data['terjangkau'] = $this->youtube_data_model->get_mentions_by_terjangkau();
		$data['tidak_terjangkau'] = $this->youtube_data_model->get_negative_mentions_by_terjangkau();
		$data['praktis'] = $this->youtube_data_model->get_mentions_by_praktis();
		$data['tidak_praktis'] = $this->youtube_data_model->get_negative_mentions_by_praktis();
		$data['puas'] = $this->youtube_data_model->get_mentions_by_puas();
		$data['tidak_puas'] = $this->youtube_data_model->get_negative_mentions_by_puas();
		$data['mantap'] = $this->youtube_data_model->get_mentions_by_mantap();
		$data['tidak_mantap'] = $this->youtube_data_model->get_negative_mentions_by_mantap();


		// Load the views
		$this->load->view('partials/head');
		$this->load->view('home/home', $data);
		$this->load->view('partials/footer');
	}


	// New function to calculate positive mentions
	public function positive_mentions()
	{
		// Fetch keywords and calculate positive mentions for each
		$data['positive_mentions'] = $this->youtube_data_model->get_positive_mentions_by_keywords();
		// Load view
		$this->load->view('partials/head');
		$this->load->view('home/positive_mentions', $data); // New view for positive mentions
		$this->load->view('partials/footer');
	}
	public function get_negative_mentions()
	{
		// Fetch negative mentions for each keyword
		$data['negative_mentions'] = $this->youtube_data_model->get_negative_mentions_by_keywords();

		// Load the view (or return the data depending on your structure)
		$this->load->view('home/home', $data);
	}
	public function get_total_likes()
	{
		// Fetch total likes for each keyword
		$data['total_likes'] = $this->youtube_data_model->get_total_likes_by_keywords();

		// Load the view (or return the data depending on your structure)
		$this->load->view('home/home', $data);
	}
	public function video_analysis()
	{
		$this->load->model('youtube_data_model'); // Load your model
		$data['keywords'] = $this->youtube_data_model->get_unique_keywords(); // Get distinct keywords
		$this->load->view('video_analysis_view', $data); // Load view and pass the data
	}
	// New method to download Excel
	public function download_excel()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Set the header row
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Keyword');
		$sheet->setCellValue('C1', 'Author');
		$sheet->setCellValue('D1', 'Updated At');
		$sheet->setCellValue('E1', 'Like Count');
		$sheet->setCellValue('F1', 'Text');
		$sheet->setCellValue('G1', 'Video ID');
		$sheet->setCellValue('H1', 'Title');
		$sheet->setCellValue('I1', 'Public');
		// Apply header styles
		$headerStyle = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFFFF'],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startColor' => ['argb' => 'FF0070C0'], // Blue background
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			],
		];
		$sheet->getStyle('A1:I1')->applyFromArray($headerStyle);
		// Set the column widths for better organization
		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(25);
		$sheet->getColumnDimension('C')->setWidth(15);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(15);
		$sheet->getColumnDimension('F')->setWidth(30);
		$sheet->getColumnDimension('G')->setWidth(15);
		$sheet->getColumnDimension('H')->setWidth(25);
		$sheet->getColumnDimension('I')->setWidth(10);
		// Fetch data from the model
		$youtube_data = $this->youtube_data_model->get_all(); // Fetch all data or adjust as needed
		// Populate the spreadsheet with data
		$row = 2; // Start from the second row
		foreach ($youtube_data as $index => $val) {
			$sheet->setCellValue('A' . $row, $index + 1); // No
			$sheet->setCellValue('B' . $row, htmlspecialchars($val->keyword)); // Keyword
			$sheet->setCellValue('C' . $row, htmlspecialchars($val->author)); // Author
			$sheet->setCellValue('D' . $row, htmlspecialchars($val->updated_at)); // Updated At
			$sheet->setCellValue('E' . $row, htmlspecialchars($val->like_count)); // Like Count
			$sheet->setCellValue('F' . $row, htmlspecialchars($val->text)); // Text
			$sheet->setCellValue('G' . $row, htmlspecialchars($val->video_id)); // Video ID
			$sheet->setCellValue('H' . $row, htmlspecialchars($val->title)); // Title
			$sheet->setCellValue('I' . $row, $val->public ? 'Yes' : 'No'); // Public
			$row++;
		}
		// Apply border style for the data
		$borderStyle = [
			'borders' => [
				'outline' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => 'FF000000'],
				],
			],
		];
		$sheet->getStyle('A1:I' . $row)->applyFromArray($borderStyle);
		// Set the auto filter for the header row
		$sheet->setAutoFilter('A1:I' . ($row - 1)); // Set filter from A1 to I<last row>
		// Set headers for download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="youtube_data.xlsx"');
		header('Cache-Control: max-age=0');
		// Write the file to the output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit; // Ensure no further output is sent
	}

	public function download_excel_2()
	{
		// Create a new spreadsheet object
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Set the header row
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Keyword');
		$sheet->setCellValue('C1', 'Video ID');
		$sheet->setCellValue('D1', 'Title');
		$sheet->setCellValue('E1', 'Tags');
		$sheet->setCellValue('F1', 'Engagement Rate');
		$sheet->setCellValue('G1', 'Total Views');
		$sheet->setCellValue('H1', 'Video ID Likes');
		$sheet->setCellValue('I1', 'Channel Name');
		$sheet->setCellValue('J1', 'Subscriber Count'); // Add Subscriber Count

		// Apply header styles
		$headerStyle = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFFFF'],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startColor' => ['argb' => 'FF0070C0'], // Blue background
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			],
		];
		$sheet->getStyle('A1:J1')->applyFromArray($headerStyle);

		// Set the column widths for better organization
		$columnWidths = [
			'A' => 5,
			'B' => 25,
			'C' => 15,
			'D' => 25,
			'E' => 30,
			'F' => 15,
			'G' => 15,
			'H' => 15,
			'I' => 25,
			'J' => 15, // Set width for Subscriber Count
		];

		foreach ($columnWidths as $column => $width) {
			$sheet->getColumnDimension($column)->setWidth($width);
		}

		// Fetch data from the model
		$youtube_data = $this->youtube_data_model->get_all_2(); // Fetch all data from youtube_data_2

		// Populate the spreadsheet with data
		$row = 2; // Start from the second row
		foreach ($youtube_data as $index => $val) {
			$sheet->setCellValue('A' . $row, $index + 1); // No
			$sheet->setCellValue('B' . $row, htmlspecialchars($val->keyword)); // Keyword
			$sheet->setCellValue('C' . $row, htmlspecialchars($val->video_id)); // Video ID
			$sheet->setCellValue('D' . $row, htmlspecialchars($val->title)); // Title
			$sheet->setCellValue('E' . $row, htmlspecialchars($val->tags)); // Tags
			$sheet->setCellValue('F' . $row, htmlspecialchars($val->engagement_rate)); // Engagement Rate
			$sheet->setCellValue('G' . $row, htmlspecialchars($val->total_views)); // Total Views
			$sheet->setCellValue('H' . $row, htmlspecialchars($val->video_id_like)); // Video ID Likes
			$sheet->setCellValue('I' . $row, htmlspecialchars($val->channel_name)); // Channel Name
			$sheet->setCellValue('J' . $row, htmlspecialchars($val->subscriber_count)); // Subscriber Count
			$row++;
		}

		// Apply border style for the data
		$borderStyle = [
			'borders' => [
				'outline' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => 'FF000000'],
				],
			],
		];
		$sheet->getStyle('A1:J' . $row)->applyFromArray($borderStyle);

		// Set the auto filter for the header row
		$sheet->setAutoFilter('A1:J' . ($row - 1));

		// Set headers for download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="youtube_data_2.xlsx"');
		header('Cache-Control: max-age=0');

		// Clean output buffer before writing
		if (ob_get_length())
			ob_end_clean();

		// Write the file to the output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');

		exit; // Ensure no further output is sent
	}

	public function download_csv_3()
	{
		// Clear any output buffer to prevent corruption
		while (ob_get_level()) {
			ob_end_clean();
		}

		// Set headers for CSV file download
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="youtube_data_3.csv"');
		header('Cache-Control: max-age=0');
		header('Expires: 0');
		header('Pragma: public');

		// Open a file pointer to output directly to the browser
		$output = fopen('php://output', 'w');

		// Set the header row
		$header = [
			'No',
			'Keyword',
			'Author',
			'Updated At',
			'Like Count',
			'Text',
			'Video ID',
			'Title',
			'Public',
			'Channel Name'
		];
		fputcsv($output, $header, ';'); // Use ';' as delimiter

		// Fetch data with channel name from the model
		$youtube_data = $this->youtube_data_model->get_all_with_channel_name();

		// Define a function to add padding for better readability
		function add_padding($text, $width)
		{
			return str_pad($text, $width);
		}

		// Populate the CSV file with data
		foreach ($youtube_data as $index => $val) {
			$row = [
				add_padding($index + 1, 5),
				add_padding($val->keyword, 25),         // Widen Keyword
				add_padding($val->author, 20),          // Widen Author
				add_padding($val->updated_at, 20),      // Widen Updated At
				add_padding($val->like_count, 10),      // Widen Like Count
				add_padding(substr($val->text, 0, 50), 50),  // Shortened Text with Padding
				add_padding($val->video_id, 15),        // Video ID
				add_padding(substr($val->title, 0, 40), 40), // Shortened Title with Padding
				$val->public ? 'Yes' : 'No',
				add_padding($val->channel_name, 30),    // Widen Channel Name
			];
			fputcsv($output, $row, ';'); // Use ';' as delimiter
		}

		// Close the output file pointer
		fclose($output);

		// End script execution to prevent further output
		exit;
	}


	public function get_mentions_per_year()
	{
		$keyword = $this->input->post('keyword'); // Get the selected keyword from POST request

		// Load the model
		$this->load->model('Youtube_Data_model');

		if ($keyword === 'all') {
			// Get the sum of all mentions (text) per year
			$data = $this->youtube_data_model->get_all_mentions_per_year();
		} else {
			// Get mentions per year for the selected keyword
			$data = $this->youtube_data_model->get_mentions_by_keyword_and_year($keyword);
		}

		// Debugging: Check if data is being fetched correctly
		if (!$data) {
			log_message('error', 'No data fetched for keyword: ' . $keyword);
		}

		// Return the data in JSON format
		echo json_encode($data);
	}




	public function get_mentions_per_year_for_chart3()
	{
		$keyword = $this->input->post('keyword'); // Get the selected keyword from POST request

		// Load the model
		$this->load->model('Youtube_Data_model');

		// Fetch the data from the model
		$data = $this->youtube_data_model->get_mentions_by_keyword_and_year_for_chart3($keyword);

		// Return the data in JSON format
		echo json_encode($data);
	}

	public function get_filtered_data_like_count()
	{
		// Retrieve GET parameters for sorting
		$order = $this->input->get('order') ?? 'asc';
		$sort_by = $this->input->get('sort') ?? 'id';

		// Build query with sorting
		$this->db->from('youtube_data');

		// Apply sorting for like_count if specified
		if ($sort_by === 'like_count') {
			$this->db->order_by('like_count', $order);
		} else {
			$this->db->order_by('id', 'asc');  // Default sorting by 'id'
		}
		return $this->db->get()->result();  // Execute query and return results
	}

	public function get_positive_mentions_per_year()
	{
		$keyword = $this->input->get('keyword');
		$mentions_per_year = $this->youtube_data_model->get_positive_mentions_by_year($keyword);
		echo json_encode($mentions_per_year);
	}



	public function get_negative_mentions_per_year() {
        // Get the product filter from GET request
        $product_filter = $this->input->get('product_filter', true);

        // Debugging: log the value of the product filter
        log_message('debug', 'Product filter: ' . $product_filter);

        // Fetch the negative mentions per year with optional product filter
        $this->load->model('youtube_data_model');
        $mentions_per_year = $this->youtube_data_model->get_negative_mentions_by_year($product_filter);

        // Debugging: check the data received
        log_message('debug', 'Data returned: ' . json_encode($mentions_per_year));

        // Send the result to the view as JSON
        echo json_encode($mentions_per_year);
    }
	
	public function get_mentions_by_sentiment()
	{
		$product = $this->input->post('product');
		$sentiment = $this->input->post('sentiment');

		// Example of positive keywords (you can extend or adjust based on your requirements)
		$positive_keywords = ['Enak', 'Lezat', 'Menarik', 'Kenyal', 'Hemat', 'Terjangkau', 'Praktis', 'Puas', 'Mantap'];

		// Example of negative keywords to exclude
		$negative_keywords = [
			'tidak enak',
			'nggak enak',
			'kurang enak',
			'gk enak',
			'ndak enak',
			'gak enak',
			'tidak lezat',
			'nggak lezat',
			'kadaluarsa',
			'expired',
			'exp',
			'kadaluwarsa',
			'kedaluwarsa',
			'exp',
			'tidak layak',
			'gk layak',
			'ndak layak',
			'gak layak',
			'tidak lezat',
			'kurang lezat',
			'gk lezat',
			'ndak lezat',
			'gak lezat',
			'tidak menarik',
			'nggak menarik',
			'kurang menarik',
			'gk menarik',
			'ndak menarik',
			'gak menarik',
			'tidak kenyal',
			'nggak kenyal',
			'kurang kenyal',
			'gk kenyal',
			'ndak kenyal',
			'gak kenyal',
			'tidak hemat',
			'nggak hemat',
			'kurang hemat',
			'gk hemat',
			'ndak hemat',
			'gak hemat',
			'tidak terjangkau',
			'nggak terjangkau',
			'kurang terjangkau',
			'gk terjangkau',
			'ndak terjangkau',
			'gak terjangkau',
			'tidak praktis',
			'nggak praktis',
			'kurang praktis',
			'gk praktis',
			'ndak praktis',
			'gak praktis',
			'tidak puas',
			'nggak puas',
			'kurang puas',
			'gk puas',
			'ndak puas',
			'gak puas',
			'tidak mantap',
			'nggak mantap',
			'kurang mantap',
			'gk mantap',
			'ndak mantap',
			'gak mantap'
		];

		// Fetch filtered data from your model
		$mentions = $this->youtube_data_model->get_mentions_by_sentiment($product, $sentiment, $positive_keywords, $negative_keywords);

		// Send the response back as JSON
		echo json_encode($mentions);
	}

}