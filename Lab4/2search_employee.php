<?php
/* 
General documentation explaining what this code does:

This PHP script demonstrates a secure approach to querying a MySQL database using prepared statements with the MySQLi extension. It performs the following tasks:
1. Establishes a connection to a MySQL database using the provided server, username, password, and database name.
2. Sets the character encoding to UTF-8 for consistent data handling.
3. Checks if the database connection was successful and terminates execution with an error message if not.
4. Prepares a parameterized SQL query to search for employees with a specific first name (`firstname`).
5. Binds a variable (`$search`) to the query parameter for safe and efficient query execution.
6. Executes the prepared query and retrieves the results.
7. Iterates through the results, displaying the `id`, `firstname`, and `lastname` of each matching employee.
8. Displays "No results" if no records are found.
9. Closes the database connection after completing all operations.
*/

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
