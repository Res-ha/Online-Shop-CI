<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'username' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
            'password' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
            'level' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
            'nama' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
            'foto' => [
                'type'       => 'varchar',
                'constraint' => '256',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        //
    }
}
