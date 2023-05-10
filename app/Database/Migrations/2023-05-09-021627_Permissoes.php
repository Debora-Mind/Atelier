<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permissoes extends Migration
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
            'definicao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('permissoes', true);
    }

    public function down()
    {
        $this->forge->dropTable('permissoes', true);
    }
}
