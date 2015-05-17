<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class RequestHelpService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 5;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            $lon = $params[2];
            $lat = $params[3];
            $this->db->insert_id();
            $this->load->helper('date');
            $ok = $this->db->insert('helps',array(
                                            'title'=>$params[1],
                                            'logitude'=>$lon,
                                            'latitude'=>$lat,
                                            'time_created'=>now(),
                                            'category'=>$params[4],
                                            'status'=>1
                                            ));
            $result = array('done'=>$ok); 
            return $result;
        }
    }
}