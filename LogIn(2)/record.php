<?php
session_start();
// If user is not logged in, redirect to login page
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

// Handle search input
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}
/* 
Only excute $stmt->execute(); when the connection is made using the next format
$db = new PDO($dsn, $username, $password);
$db = new PDO("mysql:host=localhost;dbname=evento", "root", "");
and the next formar does not work
require_once 'login.php';
try
{
$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
throw new PDOException($e->getMessage(), (int)$e->getCode());
}
*/
$db = new PDO("mysql:host=localhost;dbname=evento", "root", "");

// Fetch data from 'participantes' table with search functionality
$sql = "SELECT * FROM participantes WHERE nombre LIKE :search OR apellido LIKE :search";
$stmt = $db->prepare($sql); // Use the $db object from db_conn.php

// Define the search parameter
$searchParam = "%" . $searchQuery . "%";

// Bind the parameter using bindParam (PDO's method)
$stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);

// Execute the statement
$stmt->execute();

// Fetch the results
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll for multiple results
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro de Participantes</title>
</head>
<body>
    <h1>Registro de Participantes</h1>

    <form method="GET" action="record.php">
        <input type="text" name="search" placeholder="Buscar por nombre o apellido" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Buscar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>País de Residencia</th>
                <th>Nacionalidad</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Temas</th>
                <th>Observaciones</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if $result is not empty to avoid warnings
            if (!empty($result)) {
                foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['edad']); ?></td>
                        <td><?php echo htmlspecialchars($row['sexo']); ?></td>
                        <td><?php echo htmlspecialchars($row['pais_residencia']); ?></td>
                        <td><?php echo htmlspecialchars($row['nacionalidad']); ?></td>
                        <td><?php echo htmlspecialchars($row['celular']); ?></td>
                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                        <td><?php echo htmlspecialchars($row['temas']); ?></td>
                        <td><?php echo htmlspecialchars($row['observaciones']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="12">No se encontraron resultados</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="download_xlsx.php">Descargar como XLSX</a>
    <a href="home.php">Volver a Inicio</a>
</body>
</html>