<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fakultas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
            'fakultas' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('fakultas');
    }

    public function down()
    {
        //
    }
}
