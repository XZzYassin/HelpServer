<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class HelpsAroundService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 3;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            $lon = $params[1];
            $lat = $params[2];
            $query = $this->db->query('CALL `GetAroundHelps`(?,?,?)',array($lon,$lat,$this->config->item('geo_bounds')));
            $result = array();
            foreach($query->result() as $value)
            {
                array_push($result,$value);
            }
            return $result;
        }
    }
}