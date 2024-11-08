<?php
session_start();
require 'db_connection.php';

// If user is not logged in, redirect to login page
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

$conn = new DBConnection('127.0.0.1', 'root', '', 'evento'); // Update with your DB credentials

// Handle search input
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

// Fetch data from 'participantes' table with search functionality
$sql = "SELECT * FROM participantes WHERE nombre LIKE ? OR apellido LIKE ?";
$stmt = $conn->conn->prepare($sql);
$searchParam = "%" . $searchQuery . "%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
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
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['edad']; ?></td>
                    <td><?php echo $row['sexo']; ?></td>
                    <td><?php echo $row['pais_residencia']; ?></td>
                    <td><?php echo $row['nacionalidad']; ?></td>
                    <td><?php echo $row['celular']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['temas']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="download_xlsx.php">Descargar como XLSX</a>

    <a href="home.php">Volver a Inicio</a>
</body>
</html>

<?php
$stmt->close();
$conn->closeConnection();
?>