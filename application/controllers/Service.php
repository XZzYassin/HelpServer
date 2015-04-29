<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
    public function index()
    {
        $this->load->model('GeoCalcolator');
        echo $this->GeoCalcolator->getDistance(31.972566, 35.917612,32.004705, 35.874005);
    }
}