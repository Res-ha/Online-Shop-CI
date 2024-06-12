<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $data =
                [
                    [
                        'kode'        => $faker->ean13,
                        'nama'        => $faker->name,
                        'nip'         => $faker->isbn13,
                    ]
                ];
            $this->db->table('anggota')->insertBatch($data);
        }
    }
}
