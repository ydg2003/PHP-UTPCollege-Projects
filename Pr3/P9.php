<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pregunta en Bucle</title>
</head>
<body>

<?php
// Variable to store the user's choice
$continuar = 'S'; // Initial value to start the loop

// Loop until the user inputs 'N'
while (strtoupper($continuar) !== 'N') {
    echo "<p>¿Deseas continuar? Sí (S)/No (N)</p>";
    echo '<form method="post">';
    echo '<input type="text" name="respuesta" maxlength="1" autofocus required>';
    echo '<input type="submit" value="Enviar">';
    echo '</form>';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the user's input and update the variable
        $continuar = strtoupper($_POST['respuesta']);
    }
}
?>

<p>Has terminado el bucle.</p>

</body>
</html>