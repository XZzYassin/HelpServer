<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesExecutor extends CI_Model
{
    private $request;
    
    public function executeAjaxRequest($request)
    {
        $this->request = $request;
        $this->cleanAjaxRequest(); //$this->parameters is now clean for XSS and SQL-INJECTION
        
        $this->selectService();

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
            $cleanParameter = $value;
            //$cleanParameter = $this->db->escape($this->security->xss_clean($value)); // This  line commented out because Codeigniter Query Builder (Active Record formerly) escapes input automatically
            array_push($cleanParameters,$cleanParameter);
        }
        $this->request->setParameters($cleanParameters);
    }

    private function selectService()
    {
        $parameters = $this->request->getParameters();
        $service = NULL;
        $result = NULL;
        $serviceName = strtolower($parameters[0]);
        require_once(APPPATH.'/models/services/ExecutableService.php');
        
        $this->config->load('ServicesConfig');
        $serviceConfig = $this->config->item('ServicesConfig');
        $serviceConfig = $serviceConfig[$serviceName];
        $result = $this->executeService($serviceConfig['serviceID'],
                                        $serviceConfig['serviceClass']);
        
        $this->request->setResult($result);
    }

    private function executeService($code, $model)
    {
        $this->request->type = $code;
        $this->load->model('Services/'.$model,'service');
        return $this->executeExecutableService($this->service);
    }

    private function executeExecutableService(ExecutableService $executableService)
    {
        return $executableService->execute($this->request);
    }
}