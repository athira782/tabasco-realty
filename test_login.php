<?php
$pdo = new PDO('mysql:host=localhost;dbname=tabasco_india', 'root', '');

echo "<h2>Database Check</h2>";

// Check tables
$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_NUM);
echo "<h3>Tables:</h3><ul>";
foreach ($tables as $t) {
    echo "<li>" . $t[0] . "</li>";
}
echo "</ul>";

// Check users
$users = $pdo->query('SELECT COUNT(*) as c FROM users')->fetch(PDO::FETCH_ASSOC);
echo "<h3>Users count: " . $users['c'] . "</h3>";

if ($users['c'] > 0) {
    $stmt = $pdo->query("SELECT * FROM users WHERE email='admin@tabasco.in'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo "<h3 style='color:green'>✓ Admin User Found</h3>";
        echo "<pre>";
        echo "Name: " . $row['name'] . "\n";
        echo "Email: " . $row['email'] . "\n";
        echo "Role: " . $row['role'] . "\n";
        echo "System: " . $row['system'] . "\n";
        echo "Active: " . $row['is_active'] . "\n";
        echo "Hash: " . substr($row['password'], 0, 40) . "...\n";
        echo "Password correct: " . (password_verify('admin123', $row['password']) ? 'YES ✓' : 'NO ✗') . "\n";
        echo "</pre>";
    } else {
        echo "<h3 style='color:red'>✗ admin@tabasco.in NOT FOUND</h3>";
        $all = $pdo->query('SELECT email FROM users')->fetchAll(PDO::FETCH_ASSOC);
        echo "<ul>";
        foreach ($all as $u) echo "<li>" . $u['email'] . "</li>";
        echo "</ul>";
    }
} else {
    echo "<h3 style='color:red'>✗ Users table is empty! Inserting seed data...</h3>";
    // Insert user directly
    $bytes = random_bytes(16);
    $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
    $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));

    $pdo->prepare("INSERT INTO users (id, name, email, password, role, system, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, 1, NOW(), NOW())")
        ->execute([$uuid, 'Admin User', 'admin@tabasco.in', password_hash('admin123', PASSWORD_BCRYPT), 'owner', 'india']);

    echo "<h3 style='color:green'>✓ Admin user inserted!</h3>";
}