<?php
$pdo = new PDO('mysql:host=localhost;dbname=tabasco_india', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

echo "<h2>Database Seed Check</h2>";

// Check if user exists
$stmt = $pdo->query("SELECT COUNT(*) as c FROM users WHERE email='admin@tabasco.in'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row['c'] > 0) {
    echo "<p style='color:green'>User already exists.</p>";
} else {
    // Generate UUID v4
    $bytes = random_bytes(16);
    $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
    $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));

    // Use backticks around system since it's a reserved word
    $sql = "INSERT INTO users (id, name, email, password, role, `system`, is_active, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, 1, NOW(), NOW())";

    $insert = $pdo->prepare($sql);
    $insert->execute([
        $uuid,
        'Admin User',
        'admin@tabasco.in',
        password_hash('admin123', PASSWORD_BCRYPT),
        'owner',
        'india'
    ]);

    echo "<p style='color:green'>✓ User inserted successfully.</p>";
}

// Show user count
$count = $pdo->query("SELECT COUNT(*) as c FROM users")->fetch(PDO::FETCH_ASSOC);
echo "<p>Total users in DB: <strong>" . $count['c'] . "</strong></p>";

// Verify password
$verify = $pdo->query("SELECT password, email FROM users WHERE email='admin@tabasco.in'")->fetch(PDO::FETCH_ASSOC);
if ($verify) {
    echo "<p>Password verify (admin123): " . (password_verify('admin123', $verify['password']) ? '<strong style="color:green">PASS ✓</strong>' : '<strong style="color:red">FAIL ✗</strong>') . "</p>";
}

echo "<p><a href='/tabasco-realty/public/' target='_blank'>Go to Login</a></p>";