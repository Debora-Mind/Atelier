<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Metas extends Migration
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
            'meta' => [
                'type'          => 'INT',
                'constraint'    =>  9,
                'unsigned'      => true,
            ],
            'id_produto' => [
                'type'          => 'INT',
                'constraint'    =>  9,
                'unsigned'      => true,
            ],
            'data'         => [
                'type'           => 'DATE',
            ],
            'empresa_id' => [
                'type'          => 'INT',
                'constraint'    => 9,
                'unsigned'      => true,
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => TRUE
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => TRUE
            ],
            'deleted_at'         => [
                'type'           => 'DATETIME',
                'null'           => TRUE
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey(
            'empresa_id',
            'empresas',
            'id');

        $this->forge->addForeignKey(
            'id_produto',
            'produtos',
            'id');

        $this->forge->createTable('metas', true);
    }

    public function down()
    {
        $this->forge->dropTable('metas', true);
    }
}
