<?php
$result = "";
$pdo = new PDO('mysql:host=localhost;dbname=tabasco_india', 'root', '');
$users = $pdo->query('SELECT COUNT(*) as c FROM users')->fetch(PDO::FETCH_ASSOC);
$result .= 'Users in DB: ' . $users['c'] . "\n";
if ($users['c'] > 0) {
    $row = $pdo->query("SELECT * FROM users WHERE email='admin@tabasco.in'")->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $result .= "Admin found!\n";
        $result .= "  name: " . $row['name'] . "\n";
        $result .= "  role: " . $row['role'] . "\n";
        $result .= "  system: " . $row['system'] . "\n";
        $result .= "  is_active: " . $row['is_active'] . "\n";
        $result .= "  hash: " . substr($row['password'], 0, 40) . "\n";
        $result .= "  verify admin123: " . (password_verify('admin123', $row['password']) ? 'PASS' : 'FAIL') . "\n";
    } else {
        $result .= "admin@tabasco.in NOT FOUND in table\n";
        $all = $pdo->query('SELECT email FROM users')->fetchAll(PDO::FETCH_ASSOC);
        $result .= "Users in table:\n";
        foreach ($all as $u) $result .= "  - " . $u['email'] . "\n";
    }
} else {
    $result .= "User table is EMPTY!\n";
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_NUM);
    $result .= "Tables:\n";
    foreach ($tables as $t) $result .= "  - " . $t[0] . "\n";
}
file_put_contents('check2_output.txt', $result);
echo "DONE";