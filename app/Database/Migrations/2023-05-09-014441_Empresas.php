<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Empresas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    =>  9,
                'unsigned'      => true,
                'auto_increment'=> true,
            ],
            'descricao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'ativo' => [
                'type'          => 'BOOLEAN',
                'default'       => true,
            ],
            'tema' => [
                'type'          => "ENUM('Claro', 'Escuro')",
                'default'       => 'Claro',
            ],
            'logo' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'configuracoes' => [
                'type'          => 'JSON'
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('empresas', true);
    }

    public function down()
    {
        $this->forge->dropTable('empresas', true);
    }
}
