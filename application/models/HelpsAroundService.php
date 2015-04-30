<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class HelpsAroundService extends CI_Model
{
    private $paramsRequired = 3;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            $lon = explode("'",$params[1]);
            $lon = $lon[1];
            $lat = explode("'",$params[2]);
            $lat = $lat[1];
            $query = $this->db->query('CALL `GetAroundHelps`(?,?,?)',array($lon,$lat,2.0));
            $result = array();
            foreach($query->result() as $value)
            {
                array_push($result,$value);
            }
            return $result;
        }
    }
}