<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Taloes extends Migration
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
            'num_producao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10,
            ],
            'sublote' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10,
            ],
            'quantidade' => [
                'type'          => 'INT',
                'constraint'    => 9,
                'unsigned'      => true,
            ],
            'semana' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
            ],
            'codigo_barras' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
            ],
            'data_entrada' => [
                'type'          => 'DATE',
            ],
            'data_saida' => [
                'type'          => 'DATETIME',
            ],
            'nota_fiscal' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'modelo_id' => [
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
            'modelo_id',
            'modelos',
            'id',
            'CASCADE');

        $this->forge->createTable('taloes', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('taloes', true);
    }
}