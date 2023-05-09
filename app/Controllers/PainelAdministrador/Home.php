<?php

namespace App\Controllers\PainelAdministrador;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/home');
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }
}
