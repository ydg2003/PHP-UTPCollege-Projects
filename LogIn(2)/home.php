<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['user_name']; ?></h1>
        <p>
            <ul>
                <li><a href="form.php">Event Form</a></li>
                <li><a href="record.php">Record</a></li>
                <li><a href="user_settings.php">User settings</a></li>
            </ul>
        </p>
        <a href="logout.php">Logout</a>
    </body>
    </html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>