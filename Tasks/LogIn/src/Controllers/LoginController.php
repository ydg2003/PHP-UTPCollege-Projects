<?php
session_start();
include_once __DIR__ . "/../../config/db_connection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    if (empty($username)) {
        header("Location: /src/Views/login.php?error=Username is required");
        exit();
    } elseif (empty($password)) {
        header("Location: /src/Views/login.php?error=Password is required");
        exit();
    } else {
        $query = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            if ($user['user_name'] === $username && $user['password'] === $password) {
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['id'] = $user['id'];
                header("Location: /src/Views/home.php");
                exit();
            } else {
                header("Location: /src/Views/login.php?error=Incorrect username or password");
                exit();
            }
        } else {
            header("Location: /src/Views/login.php?error=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: /src/Views/login.php");
    exit();
}
?>