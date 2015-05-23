<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class ApproveHelpService extends CI_Model implements ExecutableService
{
    private $paramsRequired = 3;
    public function execute($request)
    {
        $params = $request->getParameters();
        if(is_array($params) &&  count($params) == $this->paramsRequired)
        {
            
            $this->db->where(array(
                                'id'  => $params[1]
                            ));

            $accepted = $this->db->update('helps',array(
                                                    'status' => 3
                                                  ))
                        && $accepted;

            return array('done'=>$accepted);
        }
    }
}