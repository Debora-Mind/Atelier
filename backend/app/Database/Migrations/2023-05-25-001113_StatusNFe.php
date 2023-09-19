<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusNFe extends Migration
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
            'titulo' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  30,
                'null'          => true,
            ],
            'cor' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  30,
                'null'          => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('status_nfe', true);
    }

    public function down()
    {
        $this->forge->dropTable('status_nfe', true);
    }
}
