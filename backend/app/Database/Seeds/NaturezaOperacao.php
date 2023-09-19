<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NaturezaOperacao extends Seeder
{
    public function run()
    {
        $data = [
            [
            'id' => 1,
            'descricao' => 'VENDA',
            ],
            [
            'id' => 2,
            'descricao' => 'COMPRA',
            ],
            [
            'id' => 3,
            'descricao' => 'TRANSFERÊNCIA',
            ],
            [
            'id' => 4,
            'descricao' => 'DEVOLUÇÃO',
            ],
            [
            'id' => 5,
            'descricao' => 'IMPORTAÇÃO',
            ],
            [
            'id' => 6,
            'descricao' => 'CONSIGNAÇÃO',
            ],
            [
            'id' => 7,
            'descricao' => 'REMESSA',
            ],
        ];

        $this->db->table('natureza_operacao_nfe')->insertBatch($data);
    }
}
