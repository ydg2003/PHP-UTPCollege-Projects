<?php
// SignupForm.php
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

// Verificar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Combinar nombre y apellido
    $nombre_completo = $firstname . ' ' . $lastname;

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuarios (username, password, email, nombre_completo, fecha_nacimiento, telefono, direccion)
            VALUES ('$username', '$hashed_password', '$email', '$nombre_completo', '$fecha_nacimiento', '$phone', '$direccion')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: home.html"); // Redirigir a home.html
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg {
            background-image: url('OEFJCZCP75CZJPVSMIOLMS2UBA.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 16px;
            background-color: white;
        }
        input[type=text], input[type=password], input[type=email], input[type=tel], input[type=date], textarea {
            width: 100%;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 10px;
            padding-right: 0px;
            margin: 5px 0 22px -5px;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }
        input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=tel]:focus, input[type=date]:focus, textarea:focus {
            background-color: #ddd;
            outline: none;
        }
        .registerbtn, .homebtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
        .registerbtn:hover, .homebtn:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="bg">
        <div class="container">
            <h1>Registro</h1>
            <p>Por favor, completa este formulario para crear una cuenta.</p>
            <hr>
            <form action="" method="post">
                <label for="firstname"><b>Nombre</b></label>
                <input type="text" placeholder="Ingrese su nombre" name="firstname" required>

                <label for="lastname"><b>Apellido</b></label>
                <input type="text" placeholder="Ingrese su apellido" name="lastname" required>

                <label for="email"><b>Correo Electrónico</b></label>
                <input type="email" placeholder="Ingrese su correo electrónico" name="email" required>

                <label for="phone"><b>Teléfono</b></label>
                <input type="tel" placeholder="Ingrese su teléfono" name="phone" required>

                <label for="fecha_nacimiento"><b>Fecha de Nacimiento</b></label>
                <input type="date" placeholder="Ingrese su fecha de nacimiento" name="fecha_nacimiento" required>

                <label for="direccion"><b>Dirección</b></label>
                <textarea name="direccion" placeholder="Ingrese su dirección" required></textarea>

                <label for="username"><b>Nombre de Usuario</b></label>
                <input type="text" placeholder="Ingrese su nombre de usuario" name="username" required>

                <label for="password"><b>Contraseña</b></label>
                <input type="password" placeholder="Ingrese su contraseña" name="password" required>

                <button type="submit" class="registerbtn">Registrarse</button>
            </form>
            <form action="home.html">
                <button type="submit" class="homebtn">Inicio</button>
            </form>
        </div>
    </div>
</body>
</html>

