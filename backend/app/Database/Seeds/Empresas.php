<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Empresas extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 1,
            'nome_fantasia' => 'Administrador',
            'ativo' => true,
        ];

        $this->db->table('empresas')->insert($data);
    }
}
