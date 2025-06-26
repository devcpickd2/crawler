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
class Reports extends CI_Controller
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
        $this->load->view('home/reports', );
        $this->load->view('partials/footer');
    }

    public function download_csv()
    {
        // Clear any output buffer to prevent corruption
        while (ob_get_level()) {
            ob_end_clean();
        }

        // Get date range from input
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        // Ensure both start and end dates are provided
        if (!$start_date || !$end_date) {
            show_error("Invalid date range provided.");
        }

        // Set headers for CSV file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="CPI & Competitor.csv"');
        header('Cache-Control: max-age=0');
        header('Expires: 0');
        header('Pragma: public');

        // Open a file pointer to output directly to the browser
        $output = fopen('php://output', 'w');

        // Set the header row
        $header = [
            'No',
            'Video ID',
            'Keyword (Comment)',
            'Author',
            'Updated At (Comment)',
            'Like Count (Comment)',
            'Text (Comment)',
            'Title (Comment)',
            'Public',
            'Keyword (Video)',
            'Title (Video)',
            'Channel Name',
            'Subscriber Count',
            'Tags',
            'Engagement Rate',
            'Total Views',
            'Video Likes'
        ];
        fputcsv($output, $header, ';'); // Use ';' as delimiter

        // Fetch combined data from the model
        $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);

        // Populate the CSV file with data
        foreach ($youtube_data as $index => $row) {
            fputcsv($output, [
                $index + 1,
                $row->video_id,
                $row->keyword_comment,
                $row->author,
                $row->updated_at_comment,
                $row->like_count_comment,
                $row->text,
                $row->title_comment,
                $row->public ? 'Yes' : 'No',
                $row->keyword_video,
                $row->title_video,
                $row->channel_name,
                $row->subscriber_count,
                $row->tags,
                $row->engagement_rate,
                $row->total_views,
                $row->video_id_like
            ], ';');
        }

        // Close the output file pointer
        fclose($output);

        // End script execution to prevent further output
        exit;
    }


    // public function download_csv_cpi()
    // {
    //     // Clear any output buffer to prevent corruption
    //     while (ob_get_level()) {
    //         ob_end_clean();
    //     }

    //     // Get date range from input
    //     $start_date = $this->input->get('start_date');
    //     $end_date = $this->input->get('end_date');

    //     // Ensure both start and end dates are provided
    //     if (!$start_date || !$end_date) {
    //         show_error("Invalid date range provided.");
    //     }

    //     // Convert dates for filename formatting
    //     $start_date_formatted = date('d_M_Y', strtotime($start_date));
    //     $end_date_formatted = date('d_M_Y', strtotime($end_date));

    //     // Define keywords to filter by
    //     $keywords = [
    //         'fiesta ready meal',
    //         'fiesta ready to go',
    //         'fiesta chicken nugget',
    //         'fiesta crispy bubble',
    //         'fiesta chicken sausage',
    //         'fiesta tepung roti',
    //         'fiesta tepung bumbu',
    //         'fiesta bumbu racik',
    //         'fiesta ready to eat',
    //         'fiesta ready to serve',
    //         'champ chicken nugget',
    //         'champ sosis',
    //         'okey nugget ayam',
    //         'okey sosis',
    //         'asimo nugget',
    //         'asimo sosis',
    //         'akumo nugget',
    //         'fiesta pizza',
    //         'fiesta ramen'
    //     ];

    //     // Fetch combined data from the model
    //     $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);

    //     // Debugging: Check if any data was retrieved
    //     if (empty($youtube_data)) {
    //         show_error("No data found for the selected date range.");
    //     }

    //     // Filter data by keywords (case insensitive, trimmed)
    //     $filtered_data = array_filter($youtube_data, function ($row) use ($keywords) {
    //         return in_array(strtolower(trim($row->keyword_comment)), array_map('strtolower', $keywords));
    //     });

    //     // Debugging: Check if filtering removed all data
    //     if (empty($filtered_data)) {
    //         show_error("No data matched the selected keywords.");
    //     }

    //     // Set headers for CSV download
    //     $filename = "PT_Charoen_Pokphand_{$start_date_formatted}_To_{$end_date_formatted}.csv";
    //     header('Content-Type: text/csv');
    //     header('Content-Disposition: attachment; filename="' . $filename . '"');
    //     header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    //     header('Expires: 0');
    //     header('Pragma: public');

    //     // Open output stream
    //     $output = fopen('php://output', 'w');

    //     // Set the header row
    //     $header = [
    //         'No',
    //         'Video ID',
    //         'Keyword (Comment)',
    //         'Author',
    //         'Updated At (Comment)',
    //         'Like Count (Comment)',
    //         'Text (Comment)',
    //         'Title (Comment)',
    //         'Public',
    //         'Keyword (Video)',
    //         'Title (Video)',
    //         'Channel Name',
    //         'Subscriber Count',
    //         'Tags',
    //         'Engagement Rate',
    //         'Total Views',
    //         'Video Likes'
    //     ];
    //     fputcsv($output, $header, ';'); // Using ';' as delimiter for better Excel compatibility

    //     // Populate CSV with filtered data
    //     $index = 1;
    //     foreach ($filtered_data as $row) {
    //         fputcsv($output, [
    //             $index++,
    //             $row->video_id,
    //             $row->keyword_comment,
    //             $row->author,
    //             $row->updated_at_comment,
    //             $row->like_count_comment,
    //             $row->text,
    //             $row->title_comment,
    //             $row->public ? 'Yes' : 'No',
    //             $row->keyword_video,
    //             $row->title_video,
    //             $row->channel_name,
    //             $row->subscriber_count,
    //             $row->tags,
    //             $row->engagement_rate,
    //             $row->total_views,
    //             $row->video_id_like
    //         ], ';'); // Using ';' as delimiter
    //     }

    //     // Close output stream
    //     fclose($output);
    //     exit;
    // }

public function download_csv_cpi()
{
    // Bersihkan output buffer
    while (ob_get_level()) {
        ob_end_clean();
    }

    // Ambil tanggal dari GET parameter
    $start_date_raw = $this->input->get('start_date');
    $end_date_raw   = $this->input->get('end_date');

    // Validasi input tanggal
    if (!$start_date_raw || !$end_date_raw) {
        show_error("Invalid date range provided.");
    }

    // Tambahkan waktu untuk memastikan jangkauan penuh satu hari
    $start_date = $start_date_raw . ' 00:00:00';
    $end_date   = $end_date_raw . ' 23:59:59';

    // Format untuk nama file
    $start_date_formatted = date('d_M_Y', strtotime($start_date_raw));
    $end_date_formatted   = date('d_M_Y', strtotime($end_date_raw));

    // Daftar keyword target
    $keywords = array_map('strtolower', [
        'fiesta ready meal',
        'fiesta ready to go',
        'fiesta chicken nugget',
        'fiesta crispy bubble',
        'fiesta chicken sausage',
        'fiesta tepung roti',
        'fiesta tepung bumbu',
        'fiesta bumbu racik',
        'fiesta ready to eat',
        'fiesta ready to serve',
        'champ chicken nugget',
        'champ sosis',
        'okey nugget ayam',
        'okey sosis',
        'asimo nugget',
        'asimo sosis',
        'akumo nugget',
        'fiesta pizza',
        'fiesta ramen'
    ]);

    // Ambil data dari model
    $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);

    if (empty($youtube_data)) {
        show_error("No data found for the selected date range.");
    }

    // Filter data berdasarkan keyword komentar (substring match, case-insensitive)
$filtered_data = array_filter($youtube_data, function ($row) use ($keywords) {
    $comment = isset($row->keyword_comment) ? strtolower(trim($row->keyword_comment)) : '';
    foreach ($keywords as $keyword) {
        similar_text($keyword, $comment, $percent);
        if ($percent >= 70) { // kamu bisa sesuaikan ambang batasnya
            return true;
        }
    }
    return false;
});

    if (empty($filtered_data)) {
        show_error("No data matched the selected keywords.");
    }

    // Siapkan nama file dan header CSV
    $filename = "PT_Charoen_Pokphand_{$start_date_formatted}_To_{$end_date_formatted}.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Expires: 0');
    header('Pragma: public');

    $output = fopen('php://output', 'w');

    // Header CSV
    $header = [
        'No',
        'Video ID',
        'Keyword (Comment)',
        'Author',
        'Updated At (Comment)',
        'Like Count (Comment)',
        'Text (Comment)',
        'Title (Comment)',
        'Public',
        'Keyword (Video)',
        'Title (Video)',
        'Channel Name',
        'Subscriber Count',
        'Tags',
        'Engagement Rate',
        'Total Views',
        'Video Likes'
    ];
    fputcsv($output, $header, ';');

    // Isi data CSV
    $index = 1;
    foreach ($filtered_data as $row) {
        fputcsv($output, [
            $index++,
            $row->video_id ?? '',
            $row->keyword_comment ?? '',
            $row->author ?? '',
            $row->updated_at_comment ?? '',
            $row->like_count_comment ?? '',
            $row->text ?? '',
            $row->title_comment ?? '',
            isset($row->public) ? ($row->public ? 'Yes' : 'No') : '',
            $row->keyword_video ?? '',
            $row->title_video ?? '',
            $row->channel_name ?? '',
            $row->subscriber_count ?? '',
            $row->tags ?? '',
            $row->engagement_rate ?? '',
            $row->total_views ?? '',
            $row->video_id_like ?? ''
        ], ';');
    }

    fclose($output);
    exit;
}


//     public function download_csv_cpi_positive()
// {
//     // Clear any output buffer to prevent corruption
//     while (ob_get_level()) {
//         ob_end_clean();
//     }

//     // Get date range from input
//     $start_date = $this->input->get('start_date');
//     $end_date = $this->input->get('end_date');

//     // Ensure both start and end dates are provided
//     if (!$start_date || !$end_date) {
//         show_error("Invalid date range provided.");
//     }

//     // Convert dates for filename formatting
//     $start_date_formatted = date('d_M_Y', strtotime($start_date));
//     $end_date_formatted = date('d_M_Y', strtotime($end_date));

//     // Define keywords to filter by (matching "Keyword (Comment)" column)
//     $keywords = [
//         'fiesta ready meal',
//         'fiesta ready to go',
//         'fiesta chicken nugget',
//         'fiesta crispy bubble',
//         'fiesta chicken sausage',
//         'fiesta tepung roti',
//         'fiesta tepung bumbu',
//         'fiesta bumbu racik',
//         'fiesta ready to eat',
//         'fiesta ready to serve',
//         'champ chicken nugget',
//         'champ sosis',
//         'okey nugget ayam',
//         'okey sosis',
//         'asimo nugget',
//         'asimo sosis',
//         'akumo nugget',
//         'fiesta pizza',
//         'fiesta ramen'
//     ];

//     // Fetch combined data from the model
//     $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);

//     if (empty($youtube_data)) {
//         show_error("No data found for the selected date range.");
//     }

//     // Define positive and negative word filters (matching "Text (Comment)" column)
//     $positive_words = [
//         'enak', 'lezat', 'menarik', 'kenyal', 'hemat', 'terjangkau', 'praktis',
//         'puas', 'mantap', 'berkualitas', 'gurih', 'tekstur', 'rasa', 'endul',
//         'maknyus', 'aroma', 'juicy', 'meaty', 'bergizi', 'gizi', 'aman'
//     ];
    
//     $negative_phrases = [
//         'tidak enak', 'kurang enak', 'gk enak', 'gak enak', 'ndak enak', 'ga enak', 'nggak enak',
//         'tidak lezat', 'gk lezat', 'kurang lezat', 'tidak menarik', 'keras', 'tidak hemat',
//         'tidak praktis', 'berjamur', 'jamur', 'lendir', 'bau', 'basi', 'asam', 'gosong'
//     ];
    
//     // Blacklisted words for "title_comment"
//     $title_blacklist = [
//         'kondom', 'resep', 'resepnya', 'homemade', 'recook', 'mau bikin', 'adonan', 'masak',
//         'ford', 'fiestas', 'fiestasenelorza', 'fiestas en elorza', 'fiestaenelorza',
//         'fiesta en elorza', 'fiestascorporativas', 'fiestas coporativas', 'tengu',
//         'devina', 'chef devina', 'kreah'
//     ];

//     // Filter data
//     $filtered_data = array_filter($youtube_data, function ($row) use ($keywords, $positive_words, $negative_phrases, $title_blacklist) {
//         $comment_text = strtolower(trim($row->text)); // Normalize text from "Text (Comment)"
//         $keyword_column = strtolower(trim($row->keyword_comment)); // Normalize from "Keyword (Comment)"
//         $title_text = property_exists($row, 'title_comment') && isset($row->title_comment) ? strtolower(trim($row->title_comment)) : ''; // Check for title_comment

//         // Check if the keyword is valid
//         $valid_keyword = false;
//         foreach ($keywords as $keyword) {
//             if (stripos($keyword_column, $keyword) !== false) {
//                 $valid_keyword = true;
//                 break;
//             }
//         }
//         if (!$valid_keyword) {
//             return false; // Skip if keyword is not in the list
//         }

//         // Ensure comment contains at least one positive word
//         $contains_positive = false;
//         foreach ($positive_words as $word) {
//             if (stripos($comment_text, $word) !== false) {
//                 $contains_positive = true;
//                 break;
//             }
//         }
//         if (!$contains_positive) {
//             return false; // Skip if no positive word is found
//         }

//         // Ensure comment does not contain any negative phrase
//         foreach ($negative_phrases as $phrase) {
//             if (stripos($comment_text, $phrase) !== false) {
//                 return false; // Skip if negative phrase is found
//             }
//         }

//         // Ensure title_comment does not contain blacklisted words
//         foreach ($title_blacklist as $blacklisted_word) {
//             if (stripos($title_text, $blacklisted_word) !== false) {
//                 return false; // Skip if title_comment contains blacklisted word
//             }
//         }

//         return true;
//     });

//     if (empty($filtered_data)) {
//         show_error("No positive comments matched the selected keywords.");
//     }

//     // Set headers for CSV download
//     $filename = "PT_Charoen_Pokphand_Positive_{$start_date_formatted}_To_{$end_date_formatted}.csv";
//     header('Content-Type: text/csv');
//     header('Content-Disposition: attachment; filename="' . $filename . '"');
//     header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
//     header('Expires: 0');
//     header('Pragma: public');

//     // Open output stream
//     $output = fopen('php://output', 'w');

//     // Set the header row sesuai struktur CSV
//     fputcsv($output, [
//         'No',
//         'Video ID',
//         'Keyword (Comment)',
//         'Author',
//         'Updated At (Comment)',
//         'Like Count (Comment)',
//         'Text (Comment)',
//         'Title (Comment)',
//         'Public',
//         'Keyword (Video)',
//         'Title (Video)',
//         'Channel Name',
//         'Subscriber Count',
//         'Tags',
//         'Engagement Rate',
//         'Total Views',
//         'Video Likes'
//     ], ';');

//     // Populate CSV dengan data hasil filter
//     $index = 1;
//     foreach ($filtered_data as $row) {
//         fputcsv($output, [
//             $index++,
//             $row->video_id,
//             $row->keyword_comment, // Ensure this field is correctly mapped
//             $row->author,
//             $row->updated_at_comment,
//             $row->like_count_comment,
//             $row->text,
//             $row->title_comment, // Now correctly using title_comment
//             $row->public ? 'Yes' : 'No',
//             $row->keyword_video,
//             $row->title_video,
//             $row->channel_name,
//             $row->subscriber_count,
//             $row->tags,
//             $row->engagement_rate,
//             $row->total_views,
//             $row->video_id_like
//         ], ';');
//     }

//     fclose($output);
//     exit;
// }

public function download_csv_cpi_positive()
{
    // Clear output buffer
    while (ob_get_level()) {
        ob_end_clean();
    }

    // Get date input
    $start_date_raw = $this->input->get('start_date');
    $end_date_raw   = $this->input->get('end_date');

    if (!$start_date_raw || !$end_date_raw) {
        show_error("Invalid date range provided.");
    }

    // Tambah waktu agar mencakup satu hari penuh
    $start_date = $start_date_raw . ' 00:00:00';
    $end_date   = $end_date_raw . ' 23:59:59';

    // Format untuk nama file
    $start_date_formatted = date('d_M_Y', strtotime($start_date_raw));
    $end_date_formatted   = date('d_M_Y', strtotime($end_date_raw));

    // Daftar keyword brand/produk
    $keywords = [
        'fiesta ready meal',
        'fiesta ready to go',
        'fiesta chicken nugget',
        'fiesta crispy bubble',
        'fiesta chicken sausage',
        'fiesta tepung roti',
        'fiesta tepung bumbu',
        'fiesta bumbu racik',
        'fiesta ready to eat',
        'fiesta ready to serve',
        'champ chicken nugget',
        'champ sosis',
        'okey nugget ayam',
        'okey sosis',
        'asimo nugget',
        'asimo sosis',
        'akumo nugget',
        'fiesta pizza',
        'fiesta ramen'
    ];

    // Kata-kata positif
    $positive_words = [
        'enak', 'lezat', 'menarik', 'kenyal', 'hemat', 'terjangkau', 'praktis',
        'puas', 'mantap', 'berkualitas', 'gurih', 'tekstur', 'rasa', 'endul',
        'maknyus', 'aroma', 'juicy', 'meaty', 'bergizi', 'gizi', 'aman'
    ];

    // Frasa negatif yang akan didiskualifikasi
    $negative_phrases = [
        'tidak enak', 'kurang enak', 'gk enak', 'gak enak', 'ndak enak', 'ga enak', 'nggak enak',
        'tidak lezat', 'gk lezat', 'kurang lezat', 'tidak menarik', 'keras', 'tidak hemat',
        'tidak praktis', 'berjamur', 'jamur', 'lendir', 'bau', 'basi', 'asam', 'gosong'
    ];

    // Blacklist pada judul komentar
    $title_blacklist = [
        'kondom', 'resep', 'resepnya', 'homemade', 'recook', 'mau bikin', 'adonan', 'masak',
        'ford', 'fiestas', 'fiestasenelorza', 'fiestas en elorza', 'fiestaenelorza',
        'fiesta en elorza', 'fiestascorporativas', 'fiestas coporativas', 'tengu',
        'devina', 'chef devina', 'kreah'
    ];

    // Ambil data dari model
    $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);

    if (empty($youtube_data)) {
        show_error("No data found for the selected date range.");
    }

    // Fuzzy filter untuk komentar positif
    $filtered_data = array_filter($youtube_data, function ($row) use ($keywords, $positive_words, $negative_phrases, $title_blacklist) {
        $comment_text = strtolower(trim($row->text ?? ''));
        $keyword_column = strtolower(trim($row->keyword_comment ?? ''));
        $title_text = strtolower(trim($row->title_comment ?? ''));

        // Fuzzy match keyword_comment
        $valid_keyword = false;
        foreach ($keywords as $keyword) {
            similar_text($keyword, $keyword_column, $percent);
            if ($percent >= 80) {
                $valid_keyword = true;
                break;
            }
        }
        if (!$valid_keyword) {
            return false;
        }

        // Fuzzy match komentar positif
        $contains_positive = false;
        foreach ($positive_words as $word) {
            if (stripos($comment_text, $word) !== false) {
                $contains_positive = true;
                break;
            } else {
                // Fuzzy check per kata di komentar (token)
                $words_in_comment = preg_split('/[\s,.!?;]+/', $comment_text);
                foreach ($words_in_comment as $token) {
                    similar_text($word, $token, $percent);
                    if ($percent >= 80) {
                        $contains_positive = true;
                        break 2;
                    }
                }
            }
        }
        if (!$contains_positive) {
            return false;
        }

        // Pengecekan eksak frasa negatif
        foreach ($negative_phrases as $phrase) {
            if (stripos($comment_text, $phrase) !== false) {
                return false;
            }
        }

        // Pengecekan eksak blacklist judul
        foreach ($title_blacklist as $blacklisted_word) {
            if (stripos($title_text, $blacklisted_word) !== false) {
                return false;
            }
        }

        return true;
    });

    if (empty($filtered_data)) {
        show_error("No positive comments matched the selected keywords.");
    }

    // Persiapkan file CSV
    $filename = "PT_Charoen_Pokphand_Positive_{$start_date_formatted}_To_{$end_date_formatted}.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Expires: 0');
    header('Pragma: public');

    $output = fopen('php://output', 'w');

    // Header CSV
    fputcsv($output, [
        'No',
        'Video ID',
        'Keyword (Comment)',
        'Author',
        'Updated At (Comment)',
        'Like Count (Comment)',
        'Text (Comment)',
        'Title (Comment)',
        'Public',
        'Keyword (Video)',
        'Title (Video)',
        'Channel Name',
        'Subscriber Count',
        'Tags',
        'Engagement Rate',
        'Total Views',
        'Video Likes'
    ], ';');

    // Tulis isi CSV
    $index = 1;
    foreach ($filtered_data as $row) {
        fputcsv($output, [
            $index++,
            $row->video_id ?? '',
            $row->keyword_comment ?? '',
            $row->author ?? '',
            $row->updated_at_comment ?? '',
            $row->like_count_comment ?? '',
            $row->text ?? '',
            $row->title_comment ?? '',
            isset($row->public) ? ($row->public ? 'Yes' : 'No') : '',
            $row->keyword_video ?? '',
            $row->title_video ?? '',
            $row->channel_name ?? '',
            $row->subscriber_count ?? '',
            $row->tags ?? '',
            $row->engagement_rate ?? '',
            $row->total_views ?? '',
            $row->video_id_like ?? ''
        ], ';');
    }

    fclose($output);
    exit;
}


    // public function excel_cpi_negative()
    // {
    //     // Clear any output buffer to prevent corruption
    //     while (ob_get_level()) {
    //         ob_end_clean();
    //     }

    //     // Get date range from input
    //     $start_date = $this->input->get('start_date');
    //     $end_date = $this->input->get('end_date');

    //     // Ensure both start and end dates are provided
    //     if (!$start_date || !$end_date) {
    //         show_error("Invalid date range provided.");
    //     }

    //     // Convert dates to the desired format (d/M/Y)
    //     $start_date_formatted = date('d/M/Y', strtotime($start_date));
    //     $end_date_formatted = date('d/M/Y', strtotime($end_date));

    //     // Define the keywords to filter by
    //     $keywords = [
    //         'fiesta ready meal',
    //         'fiesta ready to go',
    //         'fiesta chicken nugget',
    //         'fiesta crispy bubble',
    //         'fiesta chicken sausage',
    //         'fiesta tepung roti',
    //         'fiesta tepung bumbu',
    //         'fiesta bumbu racik',
    //         'fiesta ready to eat',
    //         'fiesta ready to serve',
    //         'champ chicken nugget',
    //         'champ sosis',
    //         'okey nugget ayam',
    //         'okey sosis',
    //         'asimo nugget',
    //         'asimo sosis',
    //         'akumo nugget',
    //         'fiesta pizza',
    //         'fiesta ramen'
    //     ];

    //     // Set headers for CSV file download
    //     $filename = "PT_Charoen_Pokphand_{$start_date_formatted}_To_{$end_date_formatted}.csv";
    //     header('Content-Type: text/csv; charset=UTF-8');
    //     header('Content-Disposition: attachment; filename="' . $filename . '"');
    //     header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    //     header('Expires: 0');
    //     header('Pragma: public');

    //     // Open output stream
    //     $output = fopen('php://output', 'w');

    //     // Add UTF-8 BOM to fix encoding issues in Excel
    //     fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    //     // Set the header row
    //     $header = [
    //         'No',
    //         'Video ID',
    //         'Keyword (Comment)',
    //         'Author',
    //         'Updated At (Comment)',
    //         'Like Count (Comment)',
    //         'Text (Comment) - Only Negative Mention',
    //         'Title (Comment)',
    //         'Public',
    //         'Keyword (Video)',
    //         'Title (Video)',
    //         'Channel Name',
    //         'Subscriber Count',
    //         'Tags',
    //         'Engagement Rate',
    //         'Total Views',
    //         'Video Likes'
    //     ];
    //     fputcsv($output, $header, ';');

    //     // Fetch combined data from the model
    //     $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);

    //     // Ensure data is available
    //     if (!$youtube_data) {
    //         fputcsv($output, ['No data available for the selected date range.'], ';');
    //         fclose($output);
    //         exit;
    //     }

    //     // Fetch data with negative mentions from the model
    //     $negative_mentions = $this->youtube_data_model->get_all_negative_mentions();

    //     // Filter and extract only the negative mention
    //     $filtered_data = [];
    //     foreach ($youtube_data as $row) {
    //         $keyword_match = in_array(strtolower(trim($row->keyword_comment)), array_map('strtolower', $keywords));

    //         $negative_text = '';
    //         foreach ($negative_mentions as $negative_row) {
    //             if (strpos(strtolower($row->text), strtolower($negative_row->text)) !== false) {
    //                 $negative_text = $negative_row->text;
    //                 break; // Take only the first matched negative mention
    //             }
    //         }

    //         if ($keyword_match && $negative_text) {
    //             $filtered_data[] = [
    //                 count($filtered_data) + 1,
    //                 $row->video_id,
    //                 $row->keyword_comment,
    //                 $row->author,
    //                 $row->updated_at_comment,
    //                 $row->like_count_comment,
    //                 $negative_text, // Only showing the negative mention
    //                 $row->title_comment,
    //                 $row->public ? 'Yes' : 'No',
    //                 $row->keyword_video,
    //                 $row->title_video,
    //                 $row->channel_name,
    //                 $row->subscriber_count,
    //                 $row->tags,
    //                 $row->engagement_rate,
    //                 $row->total_views,
    //                 $row->video_id_like
    //             ];
    //         }
    //     }

    //     // Check if filtered data exists
    //     if (empty($filtered_data)) {
    //         fputcsv($output, ['No data matched the selected criteria.'], ';');
    //         fclose($output);
    //         exit;
    //     }

    //     // Populate the CSV file with filtered data
    //     foreach ($filtered_data as $row) {
    //         fputcsv($output, $row, ';');
    //     }

    //     // Close the output file pointer
    //     fclose($output);

    //     // End script execution to prevent further output
    //     exit;
    // }

public function excel_cpi_negative()
{
    // Clear output buffer
    while (ob_get_level()) {
        ob_end_clean();
    }

    // Get input dates
    $start_date = $this->input->get('start_date');
    $end_date   = $this->input->get('end_date');

    if (!$start_date || !$end_date) {
        show_error("Invalid date range provided.");
    }

    // Format for filename
    $start_date_formatted = date('d_M_Y', strtotime($start_date));
    $end_date_formatted   = date('d_M_Y', strtotime($end_date));

    // Define target keywords (lowercased for matching)
    $keywords = [
        'fiesta ready meal',
        'fiesta ready to go',
        'fiesta chicken nugget',
        'fiesta crispy bubble',
        'fiesta chicken sausage',
        'fiesta tepung roti',
        'fiesta tepung bumbu',
        'fiesta bumbu racik',
        'fiesta ready to eat',
        'fiesta ready to serve',
        'champ chicken nugget',
        'champ sosis',
        'okey nugget ayam',
        'okey sosis',
        'asimo nugget',
        'asimo sosis',
        'akumo nugget',
        'fiesta pizza',
        'fiesta ramen'
    ];

    $keywords = array_map('strtolower', $keywords); // Normalisasi

    // Setup CSV output
    $filename = "PT_Charoen_Pokphand_{$start_date_formatted}_To_{$end_date_formatted}_NEGATIVE.csv";
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Expires: 0');
    header('Pragma: public');

    $output = fopen('php://output', 'w');
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM

    // CSV Header
    $header = [
        'No',
        'Video ID',
        'Keyword (Comment)',
        'Author',
        'Updated At (Comment)',
        'Like Count (Comment)',
        'Text (Comment) - Only Negative Mention',
        'Title (Comment)',
        'Public',
        'Keyword (Video)',
        'Title (Video)',
        'Channel Name',
        'Subscriber Count',
        'Tags',
        'Engagement Rate',
        'Total Views',
        'Video Likes'
    ];
    fputcsv($output, $header, ';');

    // Ambil data
    $youtube_data = $this->youtube_data_model->get_combined_data($start_date, $end_date);
    $negative_mentions = $this->youtube_data_model->get_all_negative_mentions();

    if (empty($youtube_data) || empty($negative_mentions)) {
        fputcsv($output, ['No data available for the selected date range or no negative mentions.'], ';');
        fclose($output);
        exit;
    }

    // Ubah daftar negative mentions ke lowercase
    $negative_terms = array_map(function ($item) {
        return strtolower(trim($item->text));
    }, $negative_mentions);

    // Helper: fuzzy match keyword_comment
    function is_similar_keyword($input, $keywords, $threshold = 70)
    {
        $input = strtolower(trim($input));
        foreach ($keywords as $keyword) {
            similar_text($input, $keyword, $percent);
            if ($percent >= $threshold) {
                return true;
            }
        }
        return false;
    }

    // Filtering & output
    $filtered_data = [];
    $no = 1;
    foreach ($youtube_data as $row) {
        $keyword_comment = $row->keyword_comment ?? '';
        $text_comment    = $row->text ?? '';

        $keyword_match = is_similar_keyword($keyword_comment, $keywords);

        $matched_negative = '';
        foreach ($negative_terms as $term) {
            if ($term && strpos(strtolower($text_comment), $term) !== false) {
                $matched_negative = $term;
                break;
            }
        }

        if ($keyword_match && $matched_negative) {
            fputcsv($output, [
                $no++,
                $row->video_id ?? '',
                $row->keyword_comment ?? '',
                $row->author ?? '',
                $row->updated_at_comment ?? '',
                $row->like_count_comment ?? '',
                $matched_negative,
                $row->title_comment ?? '',
                isset($row->public) ? ($row->public ? 'Yes' : 'No') : '',
                $row->keyword_video ?? '',
                $row->title_video ?? '',
                $row->channel_name ?? '',
                $row->subscriber_count ?? '',
                $row->tags ?? '',
                $row->engagement_rate ?? '',
                $row->total_views ?? '',
                $row->video_id_like ?? ''
            ], ';');
        }
    }

    fclose($output);
    exit;
}


}


