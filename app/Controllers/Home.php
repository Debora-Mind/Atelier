<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'ATELIER',
            'msg' => []
        ];
        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header', $data);
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }
}
