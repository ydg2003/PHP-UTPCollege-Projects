<?php
// Include the database connection
//include 'db_connection.php'; // Ensure this file contains a proper PDO connection setup
$db = new PDO("mysql:host=localhost;dbname=evento", "root", "");; // Replace with your DB credentials

// Retrieve users from the database (Functionality F1)
try {
    $query = $db->query("SELECT * FROM users");
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error retrieving data: " . $e->getMessage();
}

// Functionality F4: Retrieve User Privileges
$privileges = [];
try {
    $privilegesQuery = $db->query("SHOW GRANTS FOR CURRENT_USER()");
    $privileges = $privilegesQuery->fetchAll(PDO::FETCH_NUM);
} catch (Exception $e) {
    echo "Error retrieving privileges: " . $e->getMessage();
}

// Functionality for Update, Delete, Insert will be handled below
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form was for adding a new user
    if (isset($_POST['add_user'])) {
        // Add User Code Here
        $stmt = $db->prepare("INSERT INTO users (user_name, password, name, surname, identity_document, email, activity_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['user_name'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['name'], $_POST['surname'], $_POST['identity_document'], $_POST['email'], $_POST['activity_status']]);
    }
    // Check if the form was for updating an existing user
    elseif (isset($_POST['update_user'])) {
        // Update User Code Here
        $stmt = $db->prepare("UPDATE users SET user_name = ?, name = ?, surname = ?, identity_document = ?, email = ?, activity_status = ? WHERE id = ?");
        $stmt->execute([$_POST['user_name'], $_POST['name'], $_POST['surname'], $_POST['identity_document'], $_POST['email'], $_POST['activity_status'], $_POST['id']]);
    }
    // Check if the form was for deleting a user
    elseif (isset($_POST['delete_user'])) {
        // Delete User Code Here
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Settings</title>
</head>
<body>
    <h1>User Settings</h1>
    
    <!-- Output users table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Identity Document</th>
            <th>Email</th>
            <th>Activity Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['user_name']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['surname']) ?></td>
            <td><?= htmlspecialchars($user['identity_document']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['activity_status'] ? 'Active' : 'Inactive' ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="delete_user">Delete</button>
                    <button type="submit" name="update_user">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form to add new user -->
    <h2>Add New User</h2>
    <form method="POST">
        <input type="text" name="user_name" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="surname" placeholder="Surname" required>
        <input type="text" name="identity_document" placeholder="ID Document" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="activity_status">
            <option value="0">Inactive</option>
            <option value="1">Active</option>
        </select>
        <button type="submit" name="add_user">Add User</button>
    </form>

    <!-- Output User Privileges (F4) -->
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
</body>
</html>