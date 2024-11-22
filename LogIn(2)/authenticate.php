<?php
//authenticate.php
error_reporting(E_ALL);
session_start();
require_once 'login.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_POST['user_name']) && isset($_POST['password'])) {
    function sanitise($str) {
        return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
    }

    $user_name = sanitise($_POST['user_name']);
    $password = sanitise($_POST['password']);

    if (empty($user_name)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } elseif (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}