<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $table = $db->table('users');

        $now = date('Y-m-d H:i:s');

        $users = [
            [
                'name'       => 'Administrator Parentela',
                'email'      => 'admin@parentela.id',
                'password'   => password_hash('Admin123!', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Administrator Parentela',
                'email'      => 'admin@gmail.com',
                'password'   => password_hash('Admin123!', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Ayah & Bunda',
                'email'      => 'keluarga@parentela.id',
                'password'   => password_hash('Keluarga123!', PASSWORD_BCRYPT),
                'role'       => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Ayah & Bunda',
                'email'      => 'keluarga@gmail.com',
                'password'   => password_hash('Keluarga123!', PASSWORD_BCRYPT),
                'role'       => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($users as $user) {
            $existing = $table->where('email', $user['email'])->get()->getRow();
            if (!$existing) {
                $table->insert($user);
            } else {
                $table->where('email', $user['email'])->update([
                    'name'       => $user['name'],
                    'password'   => $user['password'],
                    'role'       => $user['role'],
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
