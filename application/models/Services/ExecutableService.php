<?php
defined('BASEPATH') OR exit('No direct script access allowed');

interface ExecutableService
{
    public function execute($request);
}