<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesExecutor extends CI_Model
{
    private $request;
    
    public function executeAjaxRequest($request)
    {
        $this->request = $request;
        $this->cleanAjaxRequest(); //$this->parameters is now clean for XSS and SQL-INJECTION
        
        $this->executeService();
        

        $CI = & get_instance();
        $CI->load->library('JsonFactory',NULL,'jf');
        //TO-DO: Encrypt Model at this point........
        $this->request->setResult($CI->jf->createJsonModel($this->request->getResult()));
        return $this->request;
    }


    //this method is blocked because of the parameters passing tecnique
    //public function decryptAjaxRequest()
    //{
    //    $this->config->load('EncryptionConfig');
    //    $this->load->library('encrypt');

    //    $decryptedParameters = array();

    //    $key = $this->config->item('DATA_ENCRYPTION_KEY');
    //    $this->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
    //    $parameters = $this->request->getParameters();
    //    foreach($parameters as $value)
    //        array_push($decryptedParameters,$this->encrypt->decode($value,$key));
    //    $this->request->setParameters($decryptedParameters);
    //}

    //this method is blocked because of the parameters passing tecnique
    //public function encryptAjaxRequest()
    //{
    //    $this->config->load('EncryptionConfig');
    //    $this->load->library('encrypt');

    //    $decryptedParameters = array();

    //    $key = $this->config->item('DATA_ENCRYPTION_KEY');
    //    $this->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
    //    $parameters = $this->request->getParameters();
    //    foreach($parameters as $value)
    //        array_push($decryptedParameters,$this->encrypt->encode($value,$key));
    //    $this->request->setParameters($decryptedParameters);
    //}

    public function cleanAjaxRequest()
    {
        $cleanParameters = array();
        $parameters = $this->request->getParameters();
        foreach($parameters as $value)
        {
            $cleanParameter = $this->db->escape($this->security->xss_clean($value));
            array_push($cleanParameters,$cleanParameter);
        }
        $this->request->setParameters($cleanParameters);
    }

    private function executeService()
    {
        $parameters = $this->request->getParameters();
        $service = NULL;
        $this->load->model('ServiceCode','code');
        $result = NULL;
        $serviceName = explode("'",strtolower($parameters[0]));
        $serviceName = $serviceName[1];
        switch($serviceName)
        {
            case "aroundhelps":
                $this->request->type = $this->code->GET_HELPS_AROUND;
                $this->load->model('HelpsAroundService','service');
                $result = $this->service->execute($this->request);
                break;

            default:
                die('Invalid Service :S');
        }
        $this->request->setResult($result);
    }
}