<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class JsonFactory
{
    public function createJsonModel($data)
    {
        $CI = & get_instance();
        $CI->load->helper('date');
        return json_encode($data,JSON_NUMERIC_CHECK);
    }
}