<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class UserInfoService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 2;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            $id = $params[1];
            $this->db->where(array('id' => (int)$id));
            $query = $this->db->get('users');
            $result = array();
            foreach($query->result() as $value)
            {
                $value->avatar = base_url() . 'images/users/' . $value->avatar;
                array_push($result,$value);
            }
            return $result;
        }
    }
}