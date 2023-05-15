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
        echo view('backend/templates-admin/html-header', $data);
        echo view('backend/templates-admin/header');
        echo view('backend/admin/home');
        echo view('backend/templates-admin/footer');
        echo view('backend/templates-admin/html-footer');
    }
}
