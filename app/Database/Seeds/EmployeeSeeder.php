<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nik'       => '0123456789',
            'nama'      => 'Ikbal Ardhi',
            'alamat'    => 'Jl. Merpati 5'
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        $this->db->table('employee')->insert($data);
    }
}
