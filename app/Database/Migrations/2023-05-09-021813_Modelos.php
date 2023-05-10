<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Modelos extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    =>  9,
                'unsigned'      => true,
                'auto_increment'=> true,
            ],
            'referencia' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
            ],
            'valor_entrada' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
            ],
            'valor_saida' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
            ],
            'img' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'roteiro_pdf' => [
                'type'          => 'TEXT',
                'null'          => true,
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
            'id',
            'CASCADE');

        $this->forge->createTable('modelos', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('modelos', true);
    }
}
