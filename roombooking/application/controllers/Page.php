<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

   function __construct()
    {
        parent::Controller();
    }

    function _remap()
    {
        $segment_count = $this->uri->total_segments();
        $segments = $this->uri->segment_array();

        if($segment_count == 0)
        {
            $this->data['title'] = 'Page Title';
            $this->load->view('home', $this->data);
        }
        elseif($segment_count == 2) // Single page
        {
            $page_url = $segments[2];
            // Handle the page request
        }
        elseif($segment_count == 3) // Page with category
        {


            $category = $segments[2];
            $page_url = $segments[3];
            // Handle the category + page request
        }
    }
}
