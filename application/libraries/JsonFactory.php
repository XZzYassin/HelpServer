<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class JsonFactory
{
    public function createJsonModel($data)
    {
        $CI = & get_instance();
        $CI->load->helper('date');
        $result = array('requestStatus'=>'OK',
                        'timeStamp'=>now());
        $data = array('result'=>$data);
        $result = array_merge($result,$data);
        return json_encode($result);
    }
}