<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employee extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
            ],
            'nama'          => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            'alamat'        => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'photo'         => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'created_at'     => [
                'type'          => 'datetime',
                'null'          => TRUE
            ],
            'updated_at'      => [
                'type'       => 'datetime',
                'null'      => TRUE
            ]

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('employee');
    }

    public function down()
    {
        $this->forge->dropTable('employee');
    }
}
