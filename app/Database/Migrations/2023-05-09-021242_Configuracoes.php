<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Configuracoes extends Migration
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
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('configuracoes', true);
    }

    public function down()
    {
        $this->forge->dropTable('configuracoes', true);
    }
}
