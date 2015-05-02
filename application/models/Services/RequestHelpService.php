<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class RequestHelpService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 3;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            
            return $result;
        }
    }
}