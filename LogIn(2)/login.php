<?php
session_start();

// Include the database connection file
require_once 'db_conn.php';
$db = new PDO("mysql:host=localhost;dbname=evento", "root", "");
// Check if form data is set
if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    // Validate input
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        // Use the connection from the DBConnection object
        $sql = "SELECT * FROM users WHERE user_name = :uname";
        $stmt = $db->prepare($sql); // Prepare the SQL statement

        // Bind the parameter
        $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);

        // Execute the statement
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists
            if ($row && $row['password'] === $pass) {
                // Start session for logged-in user
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Database query failed");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}