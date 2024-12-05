<?php
/*user_settings.php*/
// Include the database connection
session_start();
require_once 'login.php';

// Create the database connection
try {
    $db = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Retrieve and Display the Users Table
try {
    $stmt = $db->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Retrieve specific user details to update
$userToUpdate = null;
if (isset($_GET['user_name'])) {
    $userNameToUpdate = $_GET['user_name'];
    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->execute([$userNameToUpdate]);
        $userToUpdate = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Modify User Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $forename = $_POST['forename'];
    $surname = $_POST['surname'];
    $identityDocument = $_POST['identity_document'];
    $email = $_POST['email'];
    $activityStatus = isset($_POST['activity_status']) ? 1 : 0;

    try {
        $stmt = $db->prepare("UPDATE users SET user_name = ?, forename = ?, surname = ?, identity_document = ?, email = ?, activity_status = ? WHERE id = ?");
        $stmt->execute([$userName, $forename, $surname, $identityDocument, $email, $activityStatus, $userId]);
        echo "User data updated successfully!";
        header("Location: user_settings.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Change User Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $userName = $_POST['user_name'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    try {
        $stmt = $db->prepare("SELECT password FROM users WHERE user_name = ?");
        $stmt->execute([$userName]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($oldPassword, $user['password'])) {
            if ($newPassword === $confirmPassword) {
                if (strlen($newPassword) >= 8) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $stmt = $db->prepare("UPDATE users SET password = ? WHERE user_name = ?");
                    $stmt->execute([$hashedPassword, $userName]);
                    echo "Password updated successfully!";
                } else {
                    echo "New password must be at least 8 characters long.";
                }
            } else {
                echo "New passwords do not match.";
            }
        } else {
            echo "Incorrect old password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Retrieve User Privileges
$privileges = [];
try {
    $privilegesQuery = $db->query("SHOW GRANTS FOR CURRENT_USER()");
    $privileges = $privilegesQuery->fetchAll(PDO::FETCH_NUM);
} catch (Exception $e) {
    echo "Error retrieving privileges: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Settings</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <h1>User Settings</h1>

    <!-- Display Users Table -->
    <h2>Users Table</h2>
    <table border="1">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Forename</th>
                <th>Surname</th>
                <th>ID Document</th>
                <th>Email</th>
                <th>Activity Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= htmlspecialchars($user['user_name']) ?></td>
                <td><?= htmlspecialchars($user['forename']) ?></td>
                <td><?= htmlspecialchars($user['surname']) ?></td>
                <td><?= htmlspecialchars($user['identity_document']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['activity_status'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <a href="?user_name=<?= htmlspecialchars($user['user_name']) ?>">Modify</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modify User Data Form -->
    <?php if ($userToUpdate): ?>
    <h2>Modify User Data for <?= htmlspecialchars($userToUpdate['user_name']) ?></h2>
    <form method="post">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($userToUpdate['id']) ?>">
        <label>User Name: <input type="text" name="user_name" value="<?= htmlspecialchars($userToUpdate['user_name']) ?>"></label><br>
        <label>Forename: <input type="text" name="forename" value="<?= htmlspecialchars($userToUpdate['forename']) ?>"></label><br>
        <label>Surname: <input type="text" name="surname" value="<?= htmlspecialchars($userToUpdate['surname']) ?>"></label><br>
        <label>ID Document: <input type="text" name="identity_document" value="<?= htmlspecialchars($userToUpdate['identity_document']) ?>"></label><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($userToUpdate['email']) ?>"></label><br>
        <label>Activity Status: <input type="checkbox" name="activity_status" <?= $userToUpdate['activity_status'] ? 'checked' : '' ?>></label><br>
        <button type="submit" name="update_user">Update</button>
    </form>
    <?php endif; ?>

    <!-- Change User Password -->
    <h2>Change User Password</h2>
    <form method="post">
        <label>User Name: <input type="text" name="user_name" required></label><br>
        <label>Old Password: <input type="password" name="old_password" required></label><br>
        <label>New Password: <input type="password" name="new_password" required></label><br>
        <label>Confirm New Password: <input type="password" name="confirm_password" required></label><br>
        <button type="submit" name="change_password">Change Password</button>
    </form>

    <!-- Display User Privileges -->
    <h2>User Privileges</h2>
    <table border="1">
        <tr>
            <th>Privilege</th>
        </tr>
        <?php foreach ($privileges as $priv): ?>
        <tr>
            <td><?= htmlspecialchars($priv[0]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="form.php">Fill form</a>
    <a href="record.php">Record</a>
    <a href="home.php">Return Home</a>
</body>
</html>