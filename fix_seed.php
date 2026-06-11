<?php
$pdo = new PDO('mysql:host=localhost;dbname=tabasco_india', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// Check if user exists
$stmt = $pdo->query("SELECT COUNT(*) as c FROM users WHERE email='admin@tabasco.in'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row['c'] > 0) {
    echo "User already exists.\n";
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

    echo "User inserted successfully.\n";
}
echo "Done.\n";