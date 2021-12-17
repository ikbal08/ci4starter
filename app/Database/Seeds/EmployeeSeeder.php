<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik'       => '0123456789',
                'nama'      => 'Ikbal Ardhi',
                'alamat'    => 'Jl. Merpati 5',
                'slug'      => '0123456789-ikbal-ardhi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nik'       => '1234567890',
                'nama'      => 'Ilham Setiawan',
                'alamat'    => 'Jl. bangau 5',
                'slug'      => '1234567890-ilham-setiawan',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        // $this->db->table('employee')->insert($data);
        $this->db->table('employee')->insertBatch($data);
    }
}
