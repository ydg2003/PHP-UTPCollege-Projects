<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine_DB";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Buscar boletos por ID
$search = '';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM boletos WHERE id = $search";
} else {
    // Obtener todos los boletos si no hay búsqueda
    $sql = "SELECT * FROM boletos";
}
$result = $conn->query($sql);

// Actualizar boleto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_ticket'])) {
    $id = $_POST['id'];
    $pelicula_id = $_POST['pelicula_id'];
    $sucursal_id = $_POST['sucursal_id'];
    $sala_id = $_POST['sala_id'];
    $asiento_numero = $_POST['asiento_numero'];

    $sql_update = "UPDATE boletos SET pelicula_id='$pelicula_id', sucursal_id='$sucursal_id', sala_id='$sala_id', asiento_numero='$asiento_numero' WHERE id=$id";
    
    if ($conn->query($sql_update) === TRUE) {
        echo "Boleto actualizado exitosamente";
    } else {
        echo "Error actualizando boleto: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Boletos</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        h1 {
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        table td form {
            margin: 0;
        }

        input[type=text] {
            width: 90%; /* Ajustar ancho al 90% del contenedor */
            padding: 5px;
            margin: 2px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type=submit] {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            margin: 2px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type=submit]:hover {
            background-color: #0056b3;
        }

        .search-container {
            margin: 20px 0;
            text-align: center;
        }

        .search-container input[type=text] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-container input[type=submit] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container input[type=submit]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="logocine.png" alt="Logo">
    </div>
    <h1>Administrar Boletos</h1>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Buscar por ID" value="<?= htmlspecialchars($search) ?>">
            <input type="submit" value="Buscar">
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Pelicula ID</th>
            <th>Sucursal ID</th>
            <th>Sala ID</th>
            <th>Asiento Número</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST" action="">
                <td><input type="hidden" name="id" value="<?= $row['id'] ?>"><?= $row['id'] ?></td>
                <td><input type="text" name="pelicula_id" value="<?= $row['pelicula_id'] ?>"></td>
                <td><input type="text" name="sucursal_id" value="<?= $row['sucursal_id'] ?>"></td>
                <td><input type="text" name="sala_id" value="<?= $row['sala_id'] ?>"></td>
                <td><input type="text" name="asiento_numero" value="<?= $row['asiento_numero'] ?>"></td>
                <td><input type="submit" name="update_ticket" value="Actualizar"></td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
