<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuarios extends Seeder
{
    public function run()
    {
        $data = [
            'usuario' => 'debora.mello',
            'senha' => '$argon2i$v=19$m=65536,t=4,p=1$ajJlNTZTNXFRNzdTYmR1bA$DD2Inas86QsoF1DH6O0HotvLat/g7WQuprwCAXcJL30',
            'permissoes' => '["all"]',
            'funcionario_id' => null,
            'empresa_id' => 1,
        ];

        $this->db->table('usuarios')->insert($data);
    }
}
