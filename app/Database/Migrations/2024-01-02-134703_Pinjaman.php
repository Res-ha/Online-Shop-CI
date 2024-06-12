<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pinjaman extends Migration
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
            'id_anggota' => [
                'type'       => 'int',
                'constraint' => '11',
            ],
            'tanggal_pengajuan' => [
                'type' => 'date',
            ],
            'jumlah_pinjaman' => [
                'type'       => 'int',
                'constraint' => '15',
            ],
            'bunga_pinjaman' => [
                'type'       => 'int',
                'constraint' => '11',
            ],
            'tenor_pinjaman' => [
                'type'       => 'int',
                'constraint' => '11',
            ],
            'status_pinjaman' => [
                'type'       => 'varchar',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_anggota', 'anggota', 'id');
        $this->forge->createTable('pinjaman');
    }

    public function down()
    {
        //
    }
}
