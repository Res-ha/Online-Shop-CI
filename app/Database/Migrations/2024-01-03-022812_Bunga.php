<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bunga extends Migration
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
            'nama' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
            'besaran' => [
                'type'       => 'decimal',
                'constraint' => '5,2',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bunga');
    }

    public function down()
    {
        //
    }
}
