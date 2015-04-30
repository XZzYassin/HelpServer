<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxRequest extends CI_Model
{
    public $type;
    private $parameters;
    private $result;

    public function __construct()
    {
        $this->parameters = array();
    }

    public function setParameters($params)
    {
        if(is_array($params))
            $this->parameters = $params;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }
}