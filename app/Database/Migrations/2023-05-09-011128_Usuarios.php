<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
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
            'usuario' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'senha' => [
                'type'          => 'TEXT',
            ],
            'permissoes' => [
                'type'          => 'JSON'
            ],
            'funcionario_id' => [
                'type'          => 'INT',
                'constraint'    => 9,
                'unsigned'      => true,
                'null'          => true,
            ],
            'empresa_id' => [
                'type'          => 'INT',
                'constraint'    => 9,
                'unsigned'      => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey(
            'funcionario_id',
            'funcionarios',
            'id');

        $this->forge->addForeignKey(
            'empresa_id',
            'empresas',
            'id');

        $this->forge->createTable('usuarios', true);

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('usuarios', true);
    }
}
