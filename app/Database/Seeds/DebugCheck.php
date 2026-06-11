<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DebugCheck extends Seeder
{
    public function run()
    {
        // Check if admin exists
        $result = $this->db->table('users')->where('email', 'admin@tabasco.in')->get()->getRowArray();

        if ($result) {
            $verify = password_verify('admin123', $result['password']);
            echo "Admin user EXISTS.\n";
            echo "Hash: " . substr($result['password'], 0, 30) . "...\n";
            echo "Password verify (admin123): " . ($verify ? 'PASS' : 'FAIL') . "\n";
            echo "Role: " . $result['role'] . "\n";
            echo "System: " . $result['system'] . "\n";
        } else {
            echo "Admin user NOT FOUND. Inserting now...\n";

            // Generate UUID v4
            $bytes = random_bytes(16);
            $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
            $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));

            $this->db->table('users')->insert([
                'id'         => $uuid,
                'name'       => 'Admin User',
                'email'      => 'admin@tabasco.in',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'owner',
                'system'     => 'india',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            echo "Admin user inserted successfully.\n";
        }
    }
}