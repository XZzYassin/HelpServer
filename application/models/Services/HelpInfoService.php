<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class HelpInfoService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 2;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            $id = $params[1];
            $this->db->where(array('id' => (int)$id));
            $this->db->join('asked_helps','helps.id = asked_helps.help_id');
            $query = $this->db->get('helps');
            $result = array();
            foreach($query->result() as $value)
            {
                array_push($result,$value);
            }
            return $result;
        }
    }
}