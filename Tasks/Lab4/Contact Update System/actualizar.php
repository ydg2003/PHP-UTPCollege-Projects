<?php
require_once 'login.php';
/*
This PHP script is responsible for updating the phone number (celular) 
of a participant (participantes) in a database using PDO. The script 
receives data from a form, prepares an SQL update query, binds parameters 
to the query to prevent SQL injection, and executes the query to update 
the participant's information.
*/
try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Receive the data from the form
$nombre = $_POST["nombre"];
$celular = $_POST["celular"];

// SQL to update the phone number for the selected contact
$sql = "UPDATE participantes SET celular = :celular WHERE nombre = :nombre";

// Prepare the SQL statement
$stmt = $pdo->prepare($sql);

// Bind the parameters to the SQL query
$stmt->bindParam(':celular', $celular);
$stmt->bindParam(':nombre', $nombre);

// Execute the update query
if ($stmt->execute()) {
    echo '<p>Participante actualizado con éxito</p>';
} else {
    echo '<p>Hubo un error al actualizar el participante: ' . $stmt->errorInfo()[2] . '</p>';
}
?>