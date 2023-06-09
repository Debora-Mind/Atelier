<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Municipios extends Migration
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
                'null'          => true,
            ],
            'ibge' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  7,
                'null'          => true,
            ],
            'uf' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'default'       => 'RS',
            ],
            'pais' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  15,
                'default'       => 'Brasil',
            ],
            'c_pais' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  4,
                'default'       => '1058',
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('municipios', true);
    }

    public function down()
    {
        $this->forge->dropTable('municipios', true);

    }
}
