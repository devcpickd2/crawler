<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronNegativeMentions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('youtube_data_model');
        $this->load->library('email');
    }

    public function send_email_if_negative_mentions()
    {
        // Get today's negative mentions
        $today_mentions = array_filter(
            $this->youtube_data_model->check_new_negative_mentions(),
            function ($mention) {
                return isset($mention->updated_at) && date('Y-m-d', strtotime($mention->updated_at)) === date('Y-m-d');
            }
        );

        if (!empty($today_mentions)) {
            $this->send_notification_email($today_mentions);
        }
    }

    private function send_notification_email($mentions)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'cpmail.cp.co.id',
            'smtp_port' => 587,
            'smtp_user' => 'fahbi.basharo@cp.co.id',
            'smtp_pass' => 'Sirambuttuyul1@@@',
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'smtp_timeout' => 10
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('fahbi.basharo@cp.co.id', 'Negative Mentions Alert');
        $this->email->to('alfurizmaramadhani@gmail.com');
        $this->email->cc(['alfurizma.ramadhani@cp.co.id', 'muhammad.arisyi@cp.co.id']);

        $this->email->subject('New Negative Mentions Found');
        $message = "<h3>New Negative Mentions Detected</h3><ul>";

        foreach ($mentions as $mention) {
            $youtube_link = isset($mention->video_id) ?
                "<a href='https://www.youtube.com/watch?v={$mention->video_id}' target='_blank'>Watch Video</a>"
                : "No video available";

            $message .= "<li>
                        <strong>{$mention->title}</strong>: {$mention->text} (Updated: {$mention->updated_at}) 
                        <br>{$youtube_link}
                     </li>";
        }
        $message .= "</ul>";

        $this->email->message($message);

        if ($this->email->send()) {
            log_message('info', 'Email notification sent successfully.');
        } else {
            log_message('error', 'Failed to send email: ' . $this->email->print_debugger());
        }
    }

}
