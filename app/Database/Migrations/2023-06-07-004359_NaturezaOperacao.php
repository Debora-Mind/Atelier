<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NaturezaOperacao extends Migration
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
                'constraint'    =>  60,
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('natureza_operacao_nfe', true);
    }

    public function down()
    {
        $this->forge->dropTable('natureza_operacao_nfe', true);
    }
}
