<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class RequestHelpService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 7;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            $this->load->helper('date');
            $created = $this->db->insert('helps',array(
                                                    'title'=>$params[1],
                                                    'logitude'=>$params[2],
                                                    'latitude'=>$params[3],
                                                    'time_created'=>now(),
                                                    'category'=>$params[4],
                                                    'description'=>$params[5],
                                                    'status'=>1
                                                 ));
            $help_id = $this->db->insert_id();
            $asked = $this->db->insert('asked_helps',array(
                                                        'asker_id'=>$params[6],
                                                        'help_id'=>$help_id
                                                     ));
            $result = array('done'=>$created && $asked);

            return $result;
        }
    }
}