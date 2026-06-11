<?php
require __DIR__ . '/app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/Boot.php';
require APPPATH . 'Config/Services.php';

$db = \Config\Database::connect();
$builder = $db->table('users');
$count = $builder->countAll();
echo "Users count: $count\n";

if ($count > 0) {
    $user = $builder->where('email', 'admin@tabasco.in')->get()->getRowArray();
    if ($user) {
        echo "Admin found: " . $user['name'] . "\n";
        echo "Role: " . $user['role'] . "\n";
        echo "System: " . $user['system'] . "\n";
        echo "Active: " . $user['is_active'] . "\n";
        echo "Verify admin123: " . (password_verify('admin123', $user['password']) ? 'PASS' : 'FAIL') . "\n";
    } else {
        echo "Admin user with email admin@tabasco.in NOT found\n";
    }
}