<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "company_info";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Set charset
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$search = "John";
$sql = "SELECT * FROM employee WHERE firstname = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    }
} else {
    echo "No results";
}

// Close connection
mysqli_close($conn);
?>
