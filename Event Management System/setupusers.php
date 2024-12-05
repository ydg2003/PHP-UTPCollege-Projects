<?php // setupusers.php
require_once 'login.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$query = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    forename VARCHAR(32) NOT NULL,
    surname VARCHAR(32) NOT NULL,
    identity_document VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    activity_status TINYINT(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

$result = $pdo->query($query);

$users = [
    ['testuser', 'testpassword', 'username', 'usersurname', 'userid', 'user@gmail.com', 1],
    ['testuser3', 'testpass2', 'testusername3', 'testuserusurname3', 'userid3', 'user3@gmail.com', 0]
];

foreach ($users as $user) {
    $user_name = $user[0];
    $password = password_hash($user[1], PASSWORD_DEFAULT);
    $forename = $user[2];
    $surname = $user[3];
    $identity_document = $user[4];
    $email = $user[5];
    $activity_status = $user[6];
    
    add_user($pdo, $user_name, $password, $forename, $surname, $identity_document, $email, $activity_status);
}

function add_user($pdo, $user_name, $password, $forename, $surname, $identity_document, $email, $activity_status)
{
    $stmt = $pdo->prepare('INSERT INTO users (user_name, password, forename, surname, identity_document, email, activity_status) VALUES (?, ?, ?, ?, ?, ?, ?)');
    
    $stmt->execute([$user_name, $password, $forename, $surname, $identity_document, $email, $activity_status]);
}
?>