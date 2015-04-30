<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceCode extends CI_Model
{
    public $LOGIN = 1;
    public $REQUEST_HELP = 2;
    public $GET_HELPS_AROUND = 3;
    public $APPROVE_HELP = 4;
    public $GET_USER_INFO = 5;
    public $REGISTER_GCM_ID = 6;
}