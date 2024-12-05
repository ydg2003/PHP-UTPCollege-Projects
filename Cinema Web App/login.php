<?php
// login.php
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
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consultar a la base de datos si el usuario es administrador
    $sql_admin = "SELECT * FROM administradores WHERE username='$user'";
    $result_admin = $conn->query($sql_admin);

    if ($result_admin->num_rows > 0) {
        // Usuario administrador encontrado, verificar contraseña
        $row_admin = $result_admin->fetch_assoc();
        if (password_verify($pass, $row_admin['password'])) {
            // Contraseña de administrador correcta
            echo "Inicio de sesión como administrador exitoso.";
            // Redirigir a menú de administrador
            header("Location: admin_menu.php");
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta para administrador.";
        }
    } else {
        // Consultar a la base de datos si el usuario es regular
        $sql_user = "SELECT * FROM usuarios WHERE username='$user'";
        $result_user = $conn->query($sql_user);

        if ($result_user->num_rows > 0) {
            // Usuario regular encontrado, verificar contraseña
            $row_user = $result_user->fetch_assoc();
            if (password_verify($pass, $row_user['password'])) {
                // Contraseña correcta
                echo "Inicio de sesión como usuario exitoso.";
                // Redirigir a menú de usuario
                header("Location: home.html");
                exit();
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta para usuario.";
            }
        } else {
            // Usuario no encontrado
            echo "Usuario no encontrado.";
        }
    }
}

$conn->close();
?>
