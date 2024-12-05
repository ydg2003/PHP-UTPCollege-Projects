<?php
/* 
General documentation explaining what this code does:
This PHP script demonstrates the use of MySQLi (MySQL Improved) for database interaction. It includes:
1. Connecting to a MySQL database using MySQLi.
2. Error handling for connection issues.
3. Executing non-prepared SQL statements to create and manage a table.
4. Using prepared statements for secure and efficient data insertion into the database.
5. Iteratively inserting multiple rows into a table using parameterized prepared statements.
6. Fetching and displaying data from the table using a non-prepared statement.
7. Properly closing the prepared statement to release resources.
*/
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