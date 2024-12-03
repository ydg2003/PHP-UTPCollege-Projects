<?php
//setupusers2.php
require_once 'login.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Function to update only user_name and password
function update_user($pdo, $id, $user_name, $password)
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('UPDATE users SET user_name = ?, password = ? WHERE id = ?');
    $stmt->execute([$user_name, $hashed_password, $id]);
}

// Example usage of update_user
$user_updates = [
    ['id' => 1, 'user_name' => 'user1', 'password' => 'pass1'],
    ['id' => 2, 'user_name' => 'user2', 'password' => 'pass2']
];

foreach ($user_updates as $update) {
    update_user($pdo, $update['id'], $update['user_name'], $update['password']);
}

echo "User records updated successfully.";
?>