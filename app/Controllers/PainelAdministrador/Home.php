<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'msg' => [],
        ];
        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header-admin', $data);
        echo view('backend/admin/home');
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }
}
