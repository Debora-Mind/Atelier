<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Teste extends ResourceController
{
    public function options()
    {
        return $this->response->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->setStatusCode(200);
    }

    function index() {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        header('Content-Type: text/plain');

        return $this->respond([
                [
                    'id' => 1,
                    'nome' => 'Bruno'
                ],
                [
                    'id' => 2,
                    'nome' => 'Caio'
                ],
                [
                    'id' => 3,
                    'nome' => 'Osmar'
                ],
        ]);
    }
}