<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeoCalcolator extends CI_Model
{
    /*
    public function getDistance($lon1, $lat1, $lon2, $lat2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return ($miles * 1.609344);
    }
    */
    // There is no use class anymore.
    // The class has been converted into MYSQL procedures.
}