<?php
/*
This PHP script provides an HTML form for updating the phone number (celular) 
of a participant (nombre) from the participantes table in the database.
*/
error_reporting(E_ALL); // Show all errors
require_once 'login.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<form method="POST" action="actualizar.php">
    Nombre:
    <br>
    <?php
    // SQL to fetch all contacts
    $sql = "SELECT nombre FROM participantes ORDER BY nombre";
    $result = $pdo->query($sql);

    // Generate a dropdown menu with contact names
    echo '<select name="nombre">';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option>' . $row["nombre"] . '</option>';
    }
    echo '</select>';
    ?>
    <br>
    Celular:
    <input type="text" name="celular" required><br>
    <input type="submit" value="Actualizar">
</form>
