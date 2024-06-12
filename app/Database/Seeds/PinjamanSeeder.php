<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PinjamanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'darth',
            'email'    => 'darth@theempire.com',
        ];

        $this->db->table('users')->insert($data);
    }
}
