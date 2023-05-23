<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ControleNFe extends Migration
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
            'serie' => [
                'type'          => 'VARACHAR',
                'constraint'    => 10,
                'unsigned'      => true,
                'null'          => true,
            ],
            'ultimonumero' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
            ],
            'ambiente' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
            ],
            'tipo_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
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

        $this->forge->createTable('produatos', true);
    }

    public function down()
    {
        $this->forge->dropTable('controle_NFe', true);
    }
}
