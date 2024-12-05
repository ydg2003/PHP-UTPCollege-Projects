<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$databaseName = "evento";

$connection = mysqli_connect($serverName, $dbUsername, $dbPassword, $databaseName);

if (!$connection) {
    echo "Connection failed!";
    exit();
}
?>