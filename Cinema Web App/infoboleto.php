<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información del Boleto</title>
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
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
        img.logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 250px; /* Ajusta este valor al tamaño deseado */
        }
        form {
            margin-top: 20px;
            text-align: center; /* Centrar el formulario dentro del contenedor */
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type=text], input[type=submit] {
            width: 100%; /* Ajusta el ancho como prefieras */
            padding: 12px 20px; /* Aumenta el tamaño del campo */
            margin: 8px 0; /* Espaciado entre campos */
            display: inline-block;
            border: 1px solid #ccc; /* Borde del campo */
            border-radius: 4px; /* Bordes redondeados */
            box-sizing: border-box; /* Para que el padding no afecte el ancho total */
        }
        input[type=submit] {
            background-color: #0033FF; /* Color de fondo */
            color: white; /* Color de texto */
            cursor: pointer; /* Cursor en forma de mano al pasar sobre el botón */
        }
        p {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
        .homebtn {
            background-color: #4CAF50; /* Color de fondo diferente para el botón de home */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            text-align: center; /* Centrar el botón dentro del contenedor */
        }
    </style>
</head>
<body>
    <div class="bg">
        <div class="container">
            <img src="logocine.png" alt="Logo" class="logo">
            <h1>Información del Boleto</h1>
            <form action="" method="get">
                <label for="boleto">Número de Boleto:</label>
                <input type="text" id="boleto" name="boleto">
                <br>
                <input type="submit" value="Buscar Boleto">
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['boleto'])) {
                    $boletoId = $_GET['boleto'];
                    if (!empty($boletoId)) {
                        include 'DatabaseHelper.php';
                        $db = new DatabaseHelper();
                        $query = "SELECT b.id, p.nombre AS pelicula, s.nombre AS sucursal, b.asiento_numero 
                                  FROM boletos b 
                                  JOIN peliculas p ON b.pelicula_id = p.id 
                                  JOIN sucursales s ON b.sucursal_id = s.id 
                                  WHERE b.id = ?";
                        $stmt = $db->conn->prepare($query);
                        $stmt->bind_param("i", $boletoId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "<p>ID de Boleto: " . $row['id'] . "</p>";
                            echo "<p>Película: " . $row['pelicula'] . "</p>";
                            echo "<p>Sucursal: " . $row['sucursal'] . "</p>";
                            echo "<p>Asiento: " . $row['asiento_numero'] . "</p>";
                        } else {
                            echo "<p>Boleto no encontrado.</p>";
                        }
                    }
                }
            ?>
            <a href="home.html" class="homebtn">Ir a la página principal</a>
        </div>
    </div>
</body>
</html>
