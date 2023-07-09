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
                'null'          => true
            ],
            'nota_fiscal' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'id_produto' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
            ],
            'id_empresa' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
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
            'id_produto',
            'produtos',
            'id');
        $this->forge->addForeignKey(
            'id_empresa',
            'empresas',
            'id');

        $this->forge->createTable('taloes', true);
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('taloes', true);
    }
}
