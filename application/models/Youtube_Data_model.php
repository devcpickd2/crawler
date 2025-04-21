<?php
date_default_timezone_set('Asia/Jakarta');
class Youtube_Data_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }
    public function get_all()
    {
        return $this->db->get('youtube_data')->result(); // Returns all rows
    }

    public function get_filtered($filters)
    {
        // Apply filters dynamically
        if (!empty($filters['limit'])) {
            $this->db->limit($filters['limit']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->like('keyword', $filters['keyword']);
        }
        if (!empty($filters['author'])) {
            $this->db->like('author', $filters['author']);
        }
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            // Filter by date range if both start_date and end_date are set
            $this->db->where('DATE(updated_at) >=', $filters['start_date']);
            $this->db->where('DATE(updated_at) <=', $filters['end_date']);
        } elseif (!empty($filters['date'])) {
            // Filter by a single date if only date is set
            $this->db->where('DATE(updated_at)', $filters['date']);
        }
        if (!empty($filters['likes'])) {
            $this->db->where('like_count', $filters['likes']);
        }
        if (!empty($filters['text'])) {
            $this->db->like('text', $filters['text']);
        }
        if (!empty($filters['video_id'])) {
            $this->db->like('video_id', $filters['video_id']);
        }
        if (!empty($filters['title'])) {
            $this->db->like('title', $filters['title']);
        }
        if (!empty($filters['public'])) {
            $this->db->where('public', $filters['public']);
        }

        $query = $this->db->get('youtube_data');
        return $query->result(); // Returns filtered results
    }

    public function get_all_mentions_per_year()
    {
        // Select year and sum of mentions (count of text) across all rows
        $this->db->select("YEAR(updated_at) as year, COUNT(text) as mentions");
        $this->db->from('youtube_data');
        $this->db->group_by("YEAR(updated_at)");
        $this->db->order_by("YEAR(updated_at)", "ASC");

        $query = $this->db->get();
        return $query->result_array(); // Return results
    }
    public function get_mentions_by_keyword_and_year($keyword)
    {
        $this->db->select("YEAR(updated_at) as year, COUNT(text) as mentions");
        $this->db->from('youtube_data');
        $this->db->where('keyword', $keyword);
        $this->db->group_by("YEAR(updated_at)");
        $this->db->order_by("YEAR(updated_at)", "ASC");

        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_all_2()
    {
        // Fetch all data from youtube_data_2 table
        $this->db->select('youtube_data_2.*');
        $query = $this->db->get('youtube_data_2');
        return $query->result();
    }
    public function get_unique_keywords()
    {
        $this->db->distinct();
        $this->db->select('keyword, title, total_views,video_id, video_id_like, engagement_rate, tags, channel_name, subscriber_count');
        $query = $this->db->get('youtube_data_2');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return [];
    }
    public function get_unique_keywords_exclude()
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
        $this->db->distinct();
        $this->db->select('keyword');
        $this->db->where_not_in('keyword', $excluded_keywords);  // Exclude specific keywords
        $query = $this->db->get('youtube_data');
        return $query->result();
    }

    public function get_keywords_to_include($excluded_keywords)
    {
        $this->db->distinct();
        $this->db->select('keyword');
        $this->db->where_in('keyword', $excluded_keywords);  // Include only the specified keywords
        $query = $this->db->get('youtube_data');
        return $query->result();
    }
    public function get_keyword_counts()
    {
        // Select keyword and count occurrences
        $this->db->select('keyword, COUNT(*) as total_mentions');
        $this->db->group_by('keyword');
        $query = $this->db->get('youtube_data');
        return $query->result();
    }
    public function get_keyword_positive_mentions($keyword)
    {
        $this->db->like('text', $keyword);
        $query = $this->db->get('youtube_data');
        return $query->result();
    }
    public function get_all_keywords()
    {
        $this->db->distinct();
        $this->db->select('keyword');
        $query = $this->db->get('youtube_data');
        return $query->result();
    }
    public function get_positive_mentions_by_keywords()
    {
        // List of positive words
        $positive_words = [
            'enak',
            'lezat',
            'menarik',
            'kenyal',
            'hemat',
            'terjangkau',
            'praktis',
            'puas',
            'mantap',
            'berkualitas',
            'kualitas',
            'gurih',
            'tekstur',
            'rasa',
            'endul',
            'maknyus',
            'aroma',
            'juicy',
            'meaty',
            'kenyal',
            'bergizi',
            'gizi',
            'aman',
            'tekstur bagus',
            'tekstur oke',
            'tekstur ok'
        ];
        // List of negative phrases to exclude
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];
        // Get all keywords from PT Charoen Pokphand
        $this->db->select('DISTINCT(keyword)');
        $keywords = $this->db->get('youtube_data')->result();
        $positive_mentions = [];
        // For each keyword, calculate positive mentions
        foreach ($keywords as $keyword) {
            $keyword_text = $keyword->keyword;

            // Start building the query to count positive mentions
            $this->db->select('COUNT(*) as positive_mentions');
            $this->db->from('youtube_data');
            $this->db->where('keyword', $keyword_text);

            // Add condition to include only comments with positive words
            $this->db->group_start();
            foreach ($positive_words as $word) {
                $this->db->or_like('text', $word);
            }
            $this->db->group_end();

            // Exclude negative phrases
            $this->db->group_start();
            foreach ($negative_phrases as $phrase) {
                $this->db->not_like('text', $phrase);
            }
            $this->db->group_end();

            $query = $this->db->get();
            $result = $query->row();

            // Store the result in the array with the keyword as the key
            $positive_mentions[$keyword_text] = $result->positive_mentions;
        }
        return $positive_mentions;
    }
    public function get_negative_mentions_by_keywords()
    {
        // List of negative phrases
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];
        // Get all keywords
        $this->db->select('DISTINCT(keyword)');
        $keywords = $this->db->get('youtube_data')->result();

        $negative_mentions = [];

        // For each keyword, calculate negative mentions
        foreach ($keywords as $keyword) {
            $keyword_text = $keyword->keyword;

            // Build the query to count negative mentions
            $this->db->select('COUNT(*) as negative_mentions');
            $this->db->from('youtube_data');
            $this->db->where('keyword', $keyword_text);

            // Add condition to include only comments with negative phrases
            $this->db->group_start();
            foreach ($negative_phrases as $phrase) {
                $this->db->or_like('text', $phrase);
            }
            $this->db->group_end();

            $query = $this->db->get();
            $result = $query->row();

            // Store the result in the array with the keyword as the key
            $negative_mentions[$keyword_text] = $result->negative_mentions;
        }

        return $negative_mentions;
    }
    public function get_total_likes_by_keywords()
    {
        $this->db->select('keyword, SUM(like_count) as total_likes');
        $this->db->group_by('keyword');
        $query = $this->db->get('youtube_data');

        $result = [];
        foreach ($query->result() as $row) {
            $keyword = strtolower(trim($row->keyword));
            $result[$keyword] = (int) $row->total_likes;
        }

        // Debug: Output the result

        return $result;
    }

    public function get_competitor_mentions($competitor_keywords)
    {
        $this->db->select('keyword, COUNT(*) as total_mentions');
        $this->db->where_in('keyword', $competitor_keywords);
        $this->db->group_by('keyword');
        $query = $this->db->get('youtube_data');
        return $query->result();
    }
    public function get_distinct_keywords()
    {
        $this->db->distinct();
        $this->db->select('keyword');
        $query = $this->db->get('youtube_data'); // Adjust table name if different

        // Ensure it returns an array of results
        return $query->result_array();
    }

    public function getOptimizedTags()
    {
        // Select the tags, total views, and engagement rate, ordered by views and reach (engagement_rate)
        $this->db->select('tags, total_views, engagement_rate');
        $this->db->from('youtube_data_2');
        $this->db->order_by('total_views', 'DESC');
        $this->db->order_by('engagement_rate', 'DESC');
        $this->db->limit(10); // Limit to top 10

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $tags = [];
            foreach ($query->result() as $row) {
                $tags = array_merge($tags, explode(',', $row->tags)); // Assuming tags are comma-separated
            }
            return array_unique($tags); // Return unique tags
        }

        return [];
    }

    public function checkTagTrending($tag)
    {
        // Select relevant fields
        $this->db->select('tags, total_views, engagement_rate');
        $this->db->from('youtube_data_2');
        $this->db->like('tags', $tag); // Search for the tag in the tags column
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Calculate average views and engagement rate for the tag
            $totalViews = 0;
            $totalEngagement = 0;
            $count = $query->num_rows();

            foreach ($query->result() as $row) {
                $totalViews += $row->total_views;
                $totalEngagement += $row->engagement_rate;
            }

            $avgViews = $totalViews / $count;
            $avgEngagement = $totalEngagement / $count;

            // Define trending criteria: e.g., 100,000 views and 5% engagement rate
            $isTrending = ($avgViews > 100000 && $avgEngagement > 5) ? true : false;

            return [
                'tag' => $tag,
                'avg_views' => $avgViews,
                'avg_engagement' => $avgEngagement,
                'is_trending' => $isTrending
            ];
        }

        return null; // No data found for the tag
    }

    public function getTop5UniqueTitles()
    {
        $this->db->select('yd.title, yd2.total_views');
        $this->db->from('youtube_data yd');
        $this->db->join('youtube_data_2 yd2', 'yd.video_id = yd2.video_id');
        $this->db->group_by('yd.title'); // Group by title to avoid duplicates
        $this->db->order_by('yd2.total_views', 'DESC'); // Order by total views descending
        $this->db->limit(5); // Limit to top 10

        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_mentions_by_sentiment($product, $sentiment, $positive_keywords, $negative_keywords)
    {
        $this->db->select('YEAR(updated_at) as year, COUNT(*) as mentions');
        $this->db->from('youtube_data');
        $this->db->where('keyword', $product);

        if (!empty($sentiment)) {
            $this->db->like('text', $sentiment); // Filter for specific sentiment
        } else {
            // Match any of the positive keywords
            $this->db->group_start(); // Open grouping for OR conditions
            foreach ($positive_keywords as $keyword) {
                $this->db->or_like('text', $keyword);
            }
            $this->db->group_end(); // Close grouping
        }

        // Exclude negative keywords
        foreach ($negative_keywords as $negative) {
            $this->db->not_like('text', $negative);
        }

        $this->db->group_by('YEAR(updated_at)');
        $query = $this->db->get();

        return $query->result_array(); // Return the filtered result
    }


    public function get_mentions_by_keyword_and_year_for_chart3($keyword)
    {
        $this->db->select("YEAR(updated_at) as year, COUNT(text) as mentions");
        $this->db->from('youtube_data');
        $this->db->where('keyword', $keyword);
        $this->db->group_by("YEAR(updated_at)");
        $this->db->order_by("YEAR(updated_at)", "ASC");

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_negative_mentions()
    {
        // List of negative phrases
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'nggak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'

        ];

        // Get all negative mentions
        $this->db->select('*');
        $this->db->from('youtube_data');

        // Add condition to include only comments with negative phrases
        $this->db->group_start();
        foreach ($negative_phrases as $phrase) {
            $this->db->or_like('text', $phrase);
        }
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_negative_mentions()
    {
        // List of negative phrases
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'nggak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        // Count mentions with negative phrases
        $this->db->from('youtube_data');

        // Add condition to include only comments with negative phrases
        $this->db->group_start();
        foreach ($negative_phrases as $phrase) {
            $this->db->or_like('text', $phrase);
        }
        $this->db->group_end();

        return $this->db->count_all_results();
    }


    public function get_all_positive_mentions()
    {
        // List of positive words
        $positive_words = [
            'enak',
            'lezat',
            'menarik',
            'kenyal',
            'hemat',
            'terjangkau',
            'praktis',
            'puas',
            'mantap',
            'berkualitas',
            'kualitas',
            'gurih',
            'tekstur',
            'rasa',
            'endul',
            'maknyus',
            'aroma',
            'juicy',
            'meaty',
            'kenyal',
            'bergizi',
            'gizi',
            'aman',
            'tekstur bagus',
            'tekstur oke',
            'tekstur ok'
        ];

        // List of negative phrases to exclude
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        // Get all positive mentions
        $this->db->select('*');
        $this->db->from('youtube_data');

        // Include only comments with positive words
        $this->db->group_start();
        foreach ($positive_words as $word) {
            $this->db->or_like('text', $word);
        }
        $this->db->group_end();

        // Exclude comments with any negative phrases
        $this->db->group_start();
        foreach ($negative_phrases as $phrase) {
            $this->db->not_like('text', $phrase);
        }
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_positive_mentions()
    {
        // List of positive words
        $positive_words = [
            'enak',
            'lezat',
            'menarik',
            'kenyal',
            'hemat',
            'terjangkau',
            'praktis',
            'puas',
            'mantap',
            'berkualitas',
            'kualitas',
            'gurih',
            'tekstur',
            'rasa',
            'endul',
            'maknyus',
            'aroma',
            'juicy',
            'meaty',
            'kenyal',
            'bergizi',
            'gizi',
            'aman',
            'tekstur bagus',
            'tekstur oke',
            'tekstur ok'
        ];

        // List of negative phrases to exclude
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        // Count positive mentions
        $this->db->from('youtube_data');

        // Include only comments with positive words
        $this->db->group_start();
        foreach ($positive_words as $word) {
            $this->db->or_like('text', $word);
        }
        $this->db->group_end();

        // Exclude comments with any negative phrases
        $this->db->group_start();
        foreach ($negative_phrases as $phrase) {
            $this->db->not_like('text', $phrase);
        }
        $this->db->group_end();

        return $this->db->count_all_results();
    }
    public function delete($id)
    {
        $this->db->where('uuid', $id);
        $this->db->delete('youtube_data');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_all_with_channel_name()
    {
        $query = $this->db->select('youtube_data.*, youtube_data_2.channel_name')
            ->from('youtube_data')
            ->join('youtube_data_2', 'youtube_data.video_id = youtube_data_2.video_id', 'left')
            ->get();
        return $query->result();
    }
    public function get_by_date_range($start_date, $end_date)
    {
        $this->db->where('updated_at >=', $start_date);
        $this->db->where('updated_at <=', $end_date);
        return $this->db->get('youtube_data')->result();
    }
    public function get_combined_data($start_date, $end_date)
    {
        $query = $this->db->query("
            SELECT 
                yd.video_id,
                yd.keyword AS keyword_comment,
                yd.author,
                yd.updated_at AS updated_at_comment,
                yd.like_count AS like_count_comment,
                yd.text,
                yd.title AS title_comment,
                yd.public,
                yd2.keyword AS keyword_video,
                yd2.title AS title_video,
                yd2.channel_name,
                yd2.subscriber_count,
                yd2.tags,
                yd2.engagement_rate,
                yd2.total_views,
                yd2.video_id_like
            FROM youtube_data yd
            LEFT JOIN youtube_data_2 yd2 ON yd.video_id = yd2.video_id
            WHERE yd.updated_at BETWEEN ? AND ?
            ORDER BY yd.updated_at
        ", [$start_date, $end_date]);

        return $query->result();
    }

    // Method for 'enak' keyword
    public function get_mentions_by_enak()
    {
        return $this->get_positive_mentions_by_keyword('enak');
    }

    // Method for 'lezat' keyword
    public function get_mentions_by_lezat()
    {
        return $this->get_positive_mentions_by_keyword('lezat');
    }

    // Method for 'menarik' keyword
    public function get_mentions_by_menarik()
    {
        return $this->get_positive_mentions_by_keyword('menarik');
    }

    // Method for 'kenyal' keyword
    public function get_mentions_by_kenyal()
    {
        return $this->get_positive_mentions_by_keyword('kenyal');
    }

    // Method for 'hemat' keyword
    public function get_mentions_by_hemat()
    {
        return $this->get_positive_mentions_by_keyword('hemat');
    }

    // Method for 'terjangkau' keyword
    public function get_mentions_by_terjangkau()
    {
        return $this->get_positive_mentions_by_keyword('terjangkau');
    }

    // Method for 'praktis' keyword
    public function get_mentions_by_praktis()
    {
        return $this->get_positive_mentions_by_keyword('praktis');
    }

    // Method for 'puas' keyword
    public function get_mentions_by_puas()
    {
        return $this->get_positive_mentions_by_keyword('puas');
    }

    // Method for 'mantap' keyword
    public function get_mentions_by_mantap()
    {
        return $this->get_positive_mentions_by_keyword('mantap');
    }

    // Common method to fetch mentions for a given positive keyword
    private function get_positive_mentions_by_keyword($keyword)
    {
        // List of negative phrases to exclude
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        // Count mentions with the specified keyword
        $this->db->from('youtube_data');
        $this->db->like('text', $keyword);

        // Exclude negative phrases
        foreach ($negative_phrases as $phrase) {
            $this->db->not_like('text', $phrase);
        }

        return $this->db->count_all_results();
    }


    // Method for 'enak' keyword (negative mentions)
    public function get_negative_mentions_by_enak()
    {
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak'
        ];

        return $this->get_negative_mentions_by_keyword('enak', $negative_phrases);
    }

    // Method for 'lezat' keyword (negative mentions)
    public function get_negative_mentions_by_lezat()
    {
        $negative_phrases = [
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat'
        ];

        return $this->get_negative_mentions_by_keyword('lezat', $negative_phrases);
    }

    // Method for 'menarik' keyword (negative mentions)
    public function get_negative_mentions_by_menarik()
    {
        $negative_phrases = [
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik'
        ];

        return $this->get_negative_mentions_by_keyword('menarik', $negative_phrases);
    }

    // Method for 'kenyal' keyword (negative mentions)
    public function get_negative_mentions_by_kenyal()
    {
        $negative_phrases = [
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras'
        ];

        return $this->get_negative_mentions_by_keyword('kenyal', $negative_phrases);
    }

    // Method for 'hemat' keyword (negative mentions)
    public function get_negative_mentions_by_hemat()
    {
        $negative_phrases = [
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat'
        ];

        return $this->get_negative_mentions_by_keyword('hemat', $negative_phrases);
    }

    // Method for 'terjangkau' keyword (negative mentions)
    public function get_negative_mentions_by_terjangkau()
    {
        $negative_phrases = [
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau'
        ];

        return $this->get_negative_mentions_by_keyword('terjangkau', $negative_phrases);
    }

    // Method for 'praktis' keyword (negative mentions)
    public function get_negative_mentions_by_praktis()
    {
        $negative_phrases = [
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis'
        ];

        return $this->get_negative_mentions_by_keyword('praktis', $negative_phrases);
    }

    // Method for 'puas' keyword (negative mentions)
    public function get_negative_mentions_by_puas()
    {
        $negative_phrases = [
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas'
        ];

        return $this->get_negative_mentions_by_keyword('puas', $negative_phrases);
    }

    // Method for 'mantap' keyword (negative mentions)
    public function get_negative_mentions_by_mantap()
    {
        $negative_phrases = [
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'ga mantap'
        ];

        return $this->get_negative_mentions_by_keyword('mantap', $negative_phrases);
    }
    // Common method to fetch negative mentions for a given keyword
    private function get_negative_mentions_by_keyword($keyword, $negative_phrases)
    {
        // Count mentions that match the negative phrases for the given keyword
        $this->db->from('youtube_data');

        // Add the phrases as conditions
        $first = true; // Use this to add the first 'where' clause properly
        foreach ($negative_phrases as $phrase) {
            if ($first) {
                $this->db->like('text', $phrase);
                $first = false;
            } else {
                $this->db->or_like('text', $phrase);
            }
        }

        return $this->db->count_all_results();
    }


    public function get_positive_mentions_by_year($keyword = 'all')
    {
        // Define the positive and negative word sets
        $positive_words = [
            'enak',
            'lezat',
            'menarik',
            'kenyal',
            'hemat',
            'terjangkau',
            'praktis',
            'puas',
            'mantap',
            'berkualitas',
            'kualitas',
            'gurih',
            'tekstur',
            'rasa',
            'endul',
            'maknyus',
            'aroma',
            'juicy',
            'meaty',
            'kenyal',
            'bergizi',
            'gizi',
            'aman',
            'tekstur bagus',
            'tekstur oke',
            'tekstur ok'
        ];

        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        // Build the query to filter positive mentions
        $this->db->select("YEAR(updated_at) as year, COUNT(*) as mentions");
        $this->db->from('youtube_data');

        // Apply keyword filter if specified
        if ($keyword !== 'all') {
            $this->db->where('keyword', $keyword);
        }

        // Filter for rows containing positive words
        $positive_conditions = [];
        foreach ($positive_words as $word) {
            $positive_conditions[] = "text LIKE '%" . $this->db->escape_like_str($word) . "%'";
        }
        $this->db->where('(' . implode(' OR ', $positive_conditions) . ')');

        // Exclude rows with negative phrases
        foreach ($negative_phrases as $phrase) {
            $this->db->where("text NOT LIKE '%" . $this->db->escape_like_str($phrase) . "%'");
        }

        $this->db->group_by("YEAR(updated_at)");
        $this->db->order_by("YEAR(updated_at)", "ASC");

        // Execute the query and return the results
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_negative_mentions_by_year($product_filter = 'all')
    {
        // List of negative phrases to look for in the 'text' column
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'nggak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        $this->db->select("YEAR(updated_at) AS year, COUNT(*) AS total_mentions");
        $this->db->from('youtube_data');

        // Check if product_filter is set and adjust query accordingly
        if ($product_filter !== 'all' && !empty($product_filter)) {
            $this->db->where('keyword', $product_filter);
        }

        // Build the condition for negative phrases in the 'text' column
        $this->db->where("(
            " . implode(" OR ", array_map(function ($phrase) {
            return "text LIKE '%" . $this->db->escape_like_str($phrase) . "%'";
        }, $negative_phrases)) . "
        )", null, false);

        // Group by year
        $this->db->group_by('year');
        $this->db->order_by('year', 'ASC');

        // Execute the query and return the results
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_new_negative_mentions()
    {
        // List of negative phrases
        $negative_phrases = [
            'tidak enak',
            'kurang enak',
            'gk enak',
            'gak enak',
            'ndak enak',
            'ga enak',
            'nggak enak',
            'tidak lezat',
            'gk lezat',
            'gak lezat',
            'kurang lezat',
            'ndak lezat',
            'ga lezat',
            'nggak lezat',
            'tidak menarik',
            'gk menarik',
            'gak menarik',
            'kurang menarik',
            'ndak menarik',
            'ga menarik',
            'nggak menarik',
            'tidak kenyal',
            'kurang kenyal',
            'gk kenyal',
            'gak kenyal',
            'ndak kenyal',
            'ga kenyal',
            'nggak kenyal',
            'keras',
            'tidak hemat',
            'gak hemat',
            'gk hemat',
            'ndak hemat',
            'ga hemat',
            'kurang hemat',
            'nggak hemat',
            'tidak terjangkau',
            'gk terjangkau',
            'gak terjangkau',
            'ndak terjangkau',
            'ga terjangkau',
            'kurang terjangkau',
            'nggak terjangkau',
            'tidak praktis',
            'kurang praktis',
            'gak praktis',
            'gk praktis',
            'tidak sepraktis',
            'ndak praktis',
            'ga praktis',
            'nggak praktis',
            'gak puas',
            'tidak puas',
            'kurang puas',
            'ndak puas',
            'ga puas',
            'nggak puas',
            'tidak mantap',
            'kurang mantap',
            'gak mantap',
            'nggak mantap',
            'gk mantap',
            'tdk mantap',
            'krg mantap',
            'ndak mantap',
            'nggak mantap',
            'ga mantap',
            'berjamur',
            'jamur',
            'jamuran',
            'lepas vacuum',
            'lepas vacum',
            'lepas vakum',
            'lendir',
            'berlendir',
            'apek',
            'bau',
            'basi',
            'asam',
            'asem',
            'gosong',
            'caking',
            'gumpal',
            'menggumpal',
            'benyek',
            'lembek',
            'tekstur busuk'
        ];

        // Get all negative mentions with a condition to include only comments with negative phrases
        $this->db->select('*');
        $this->db->from('youtube_data');
        $this->db->where('updated_at >', date('Y-m-d H:i:s', strtotime('-1 day'))); // Data yang baru ditambahkan dalam 1 hari terakhir

        // Check for negative phrases
        $this->db->group_start();
        foreach ($negative_phrases as $phrase) {
            $this->db->or_like('text', $phrase);
        }
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }

    

}