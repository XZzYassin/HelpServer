<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

$config['ServicesConfig'] = array(
    
    'aroundhelps' => array('serviceID'  => 'GET_HELPS_AROUND',
                           'serviceClass' => 'HelpsAroundService'),
    
    'login'       => array('serviceID'  => 'LOGIN',
                           'serviceClass' => 'LoginService'),

    'requesthelp' => array('serviceID'  => 'REQUEST_HELP',
                           'serviceClass' => 'RequestHelpService'),

    'accepthelp'  => array('serviceID'  => 'ACCEPT_HELP',
                           'serviceClass' => 'AcceptHelpService'), 

    'approve'     => array('serviceID'  => 'APPROVE_HELP',
                           'serviceClass' => 'ApproveHelpService'),

    'user'        => array('serviceID'  => 'GET_USER_INFO',
                           'serviceClass' => 'UserInfoService'),

    'gcm'         => array('serviceID'  => 'REGISTER_GCM_ID',
                           'serviceClass' => 'RegisterAtGcmService'),
);