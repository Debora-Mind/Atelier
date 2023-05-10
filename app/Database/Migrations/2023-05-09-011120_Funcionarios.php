<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Funcionarios extends Migration
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
            'nome' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'cpf' => [
                'type'          => 'VARCHAR',
                'constraint'    => 11,
            ],
            'data_nascimento' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'matricula' => [
                'type'          => 'VARCHAR',
                'constraint'    => 9,
            ],
            'valor_hora' => [
                'type'          => 'DOUBLE',
                'precision'     => 9,
                'scale'         => 2,
            ],
            'empresa_id' => [
                'type'          => 'INT',
                'constraint'    => 9,
                'unsigned'      => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey(
            'empresa_id',
            'empresas',
            'id');

        $this->forge->createTable('funcionarios', true);

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('funcionarios', true);
    }
}
