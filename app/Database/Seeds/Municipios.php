<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Municipios extends Seeder
{
    public function run()
    {
        $data = [
            [
            'id' => 1,
            'descricao' => 'IGREJINHA',
            'ibge' => '4310108'
            ],
            [
            'id' => 2,
            'descricao' => 'TRES COROAS',
            'ibge' => '4321709'
            ],
            [
            'id' => 3,
            'descricao' => 'PAROBE',
            'ibge' => '4314050'
            ],
        ];

        $this->db->table('municipios')->insertBatch($data);
    }
}
