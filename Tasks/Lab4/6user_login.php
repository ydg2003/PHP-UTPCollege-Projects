<?php
error_reporting(E_ALL);
/* 
Este fragmento de código define una función de inicio de sesión 
para autenticar a un usuario en un sistema que utiliza
PDO (objetos de datos PHP) con verificación de contraseña. 
El propósito general de esta función es autenticar a un usuario 
en función de su correo electrónico y contraseña y, si se realiza 
correctamente, redirigir a un usuario administrador a un panel 
específico mientras se inicia una sesión para el usuario.
*/
// Function to handle user login
function login($email, $password) {
    // Include database connection
    require_once 'login.php';

    // Prepare SQL query to fetch user details based on the email
    $stmt = $db->prepare("SELECT email, password, admin FROM users WHERE email = ?");
    
    // Execute query with the provided email
    $stmt->execute([$email]);

    // Check if any user was found
    $count = $stmt->rowCount();
    
    // Fetch the user data as an object
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    
    if ($count) {
        // If user exists, verify the password
        if (password_verify($password, $data->password)) {
            // If the user is an admin (admin = 1)
            if ($data->admin == 1) {
                // Start the session for the user
                session_start();
                
                // Set a session variable for admin user
                $_SESSION['admin'] = 'admin';
                
                // Redirect to the admin panel
                header('Location: http://localhost/prueba/panel');
                exit();  // Ensure no further code is executed after the redirect
            }
        } else {
            // If password is incorrect
            echo 'Error: Contraseña incorrecta';
        }
    } else {
        // If the user does not exist in the database
        echo 'Error: Usuario no registrado';
    }
}
?>