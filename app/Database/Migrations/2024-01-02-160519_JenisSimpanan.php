<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisSimpanan extends Migration
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
            'jumlah' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_simpanan');
    }

    public function down()
    {
        //
    }
}
