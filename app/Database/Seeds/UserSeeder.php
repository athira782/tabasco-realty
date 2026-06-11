<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Generate UUID v4
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));

        $this->db->table('users')
            ->set('id', $uuid)
            ->set('name', 'Admin User')
            ->set('email', 'admin@tabasco.in')
            ->set('password', password_hash('admin123', PASSWORD_BCRYPT))
            ->set('role', 'owner')
            ->set('`system`', 'india')
            ->set('is_active', 1)
            ->set('created_at', date('Y-m-d H:i:s'))
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->insert();

        echo "User 'Admin User' seeded successfully.\n";
    }
}