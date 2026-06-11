<?php
$dsn = 'mysql:host=localhost;dbname=tabasco_india';
try {
    $pdo = new PDO($dsn, 'root', '');
    echo "Connected to database.\n";

    $stmt = $pdo->query('SELECT COUNT(*) as c FROM users');
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Users count: " . $r['c'] . "\n";

    if ($r['c'] > 0) {
        $stmt2 = $pdo->query('SELECT email, role, system, is_active, LEFT(password, 40) as hash_pre FROM users LIMIT 1');
        $user = $stmt2->fetch(PDO::FETCH_ASSOC);
        echo "Email: " . $user['email'] . "\n";
        echo "Role: " . $user['role'] . "\n";
        echo "System: " . $user['system'] . "\n";
        echo "Active: " . $user['is_active'] . "\n";
        echo "Hash prefix: " . $user['hash_pre'] . "\n";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}