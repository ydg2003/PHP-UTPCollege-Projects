<?php
// Create connection
$mysqli = new mysqli('localhost', 'root', '', 'evento');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Non-prepared statement to create a table
if (!$mysqli->query("DROP TABLE IF EXISTS test") || !$mysqli->query("CREATE TABLE test(id INT)")) {
    echo "Failed to create table: (" . $mysqli->errno . ") " . $mysqli->error;
}

// Prepared statement: Stage 1 - Preparation
if (!($stmt = $mysqli->prepare("INSERT INTO test(id) VALUES (?)"))) {
    echo "Failed to prepare statement: (" . $mysqli->errno . ") " . $mysqli->error;
}

// Prepared statement: Stage 2 - Parameter binding and execution
$id = 1;
if (!$stmt->bind_param("i", $id)) {
    echo "Failed to bind parameters: (" . $stmt->errno . ") " . $stmt->error;
}
if (!$stmt->execute()) {
    echo "Failed to execute statement: (" . $stmt->errno . ") " . $stmt->error;
}

// Repeated execution with different values
for ($id = 2; $id < 5; $id++) {
    if (!$stmt->execute()) {
        echo "Failed to execute statement: (" . $stmt->errno . ") " . $stmt->error;
    }
}

// Explicitly closing the statement
$stmt->close();

// Non-prepared statement to fetch data
$result = $mysqli->query("SELECT id FROM test");
var_dump($result->fetch_all());
?>