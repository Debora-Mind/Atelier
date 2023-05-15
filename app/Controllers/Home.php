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

        $this->exibir($data, '');


    }

    public function exibir($data, $page)
    {
        $tipo = session('usuario')['tipo'];

        echo view('backend/templates/html-header', $data);
        if ($tipo):
            echo view('backend/templates/header-' . $tipo, $data);
        else:
            echo view('backend/templates/header', $data);
        endif;
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }
}
