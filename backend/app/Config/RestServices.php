<?php
namespace Config;

use CodeIgniter\Config\Services as CoreServices;

class RestServices extends CoreServices
{
    public static function restController($getShared = true)
    {
        if ($getShared)
        {
            return static::getSharedInstance('restController');
        }

        return new \App\Libraries\REST_Controller();
    }
}
