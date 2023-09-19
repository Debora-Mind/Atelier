<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusNFe extends Seeder
{
    public function run()
    {
        $data = [
            [
            'id' => 1,
            'titulo' => 'DIGITAÇÃO',
            'cor' => 'primary',
            ],
            [
            'id' => 2,
            'titulo' => 'FATURADA',
            'cor' => 'secondary',
            ],
            [
            'id' => 5,
            'titulo' => 'CONCUIDA',
            'cor' => 'success',
            ],
            [
            'id' => 10,
            'titulo' => 'CANCELADA',
            'cor' => 'danger',
            ],
        ];

        $this->db->table('status_nfe')->insertBatch($data);
    }
}
