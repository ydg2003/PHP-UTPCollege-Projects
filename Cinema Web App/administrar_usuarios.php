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

// Buscar usuarios por nombre o apellido
$search = '';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM usuarios WHERE nombre_completo LIKE '%$search%'";
} else {
    // Obtener todos los usuarios si no hay búsqueda
    $sql = "SELECT * FROM usuarios";
}
$result = $conn->query($sql);

// Actualizar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nombre_completo = $_POST['nombre_completo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql_update = "UPDATE usuarios SET username='$username', email='$email', nombre_completo='$nombre_completo', fecha_nacimiento='$fecha_nacimiento', telefono='$telefono', direccion='$direccion' WHERE id=$id";
    
    if ($conn->query($sql_update) === TRUE) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error actualizando usuario: " . $conn->error;
    }
}

// Actualizar contraseña de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $id = $_POST['id'];
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql_update_password = "UPDATE usuarios SET password='$hashed_password' WHERE id=$id";

    if ($conn->query($sql_update_password) === TRUE) {
        echo "Contraseña actualizada exitosamente";
    } else {
        echo "Error actualizando contraseña: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Usuarios</title>
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

        input[type=text], input[type=email], input[type=date], input[type=password] {
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
    <h1>Administrar Usuarios</h1>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Buscar por nombre o apellido" value="<?= htmlspecialchars($search) ?>">
            <input type="submit" value="Buscar">
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nombre Completo</th>
            <th>Fecha de Nacimiento</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST" action="">
                <td><input type="hidden" name="id" value="<?= $row['id'] ?>"><?= $row['id'] ?></td>
                <td><input type="text" name="username" value="<?= $row['username'] ?>"></td>
                <td><input type="email" name="email" value="<?= $row['email'] ?>"></td>
                <td><input type="text" name="nombre_completo" value="<?= $row['nombre_completo'] ?>"></td>
                <td><input type="date" name="fecha_nacimiento" value="<?= $row['fecha_nacimiento'] ?>"></td>
                <td><input type="text" name="telefono" value="<?= $row['telefono'] ?>"></td>
                <td><input type="text" name="direccion" value="<?= $row['direccion'] ?>"></td>
                <td><input type="submit" name="update_user" value="Actualizar"></td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Actualizar Contraseña</h2>
    <form method="POST" action="">
        <label for="user_id">ID del Usuario:</label>
        <input type="text" id="user_id" name="id" required>
        
        <label for="new_password">Nueva Contraseña:</label>
        <input type="password" id="new_password" name="new_password" required>
        
        <input type="submit" name="update_password" value="Actualizar Contraseña">
    </form>
</body>
</html>

