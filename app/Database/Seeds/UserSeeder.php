<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'role' => 'admin'
            ],
            [
                'username' => 'agis',
                'email' => 'agis@example.com',
                'password' => password_hash('agis', PASSWORD_BCRYPT),
                'role' => 'user'
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
