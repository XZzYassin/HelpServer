<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
    private $ajaxRequest;

    public function index()
    {
        exit('No direct script access allowed');
    }

    public function get()
    {
        $ajaxParams = $this->getAjaxParameters();
        $this->initAjaxRequest($ajaxParams);

        $this->processData();
    }

    public function set()
    {
        
    }

    public function returnAjaxResult()
    {
        echo $this->ajaxRequest->getResult();
        header('Content-Type: application/json');
    }

    private function getAjaxParameters()
    {
        $ajaxParams = array();

        for($i=3; $segment = $this->uri->segment($i);$i++)
        {
            array_push($ajaxParams,$segment);
        }

        return $ajaxParams;
    }

    private function initAjaxRequest($params)
    {
        $this->load->model('AjaxRequest','ar');
        $this->ar->setParameters($params);
        $this->ajaxRequest = $this->ar;
    }

    private function processData()
    {
        $this->load->model('ServicesExecutor','executor');
        $this->ajaxRequest = $this->executor->executeAjaxRequest($this->ajaxRequest);
        $this->returnAjaxResult();
    }
}