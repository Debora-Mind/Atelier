<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Configuracoes extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'descricao' => 'Modelos em destaque vermelho quando atingir',
            ],
            [
                'id' => 2,
                'descricao' => 'Modelos em destaque amarelo quando atingir',
            ]
        ];

        $this->db->table('configuracoes')->insertBatch($data);
    }
}
