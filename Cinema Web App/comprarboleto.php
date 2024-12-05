<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprar Boleto</title>
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
        }
        input[type=text], input[type=password], input[type=submit], select {
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
        }
    </style>
</head>
<body>
    <div class="bg">
        <div class="container">
            <img src="logocine.png" alt="Logo" class="logo">
            <h1>Comprar Boleto</h1>
            <form action="" method="post">
                <label for="pelicula">Película:</label>
                <select id="pelicula" name="pelicula">
                    <option value="">Selecciona una película</option>
                    <?php 
                        include 'DatabaseHelper.php';
                        $db = new DatabaseHelper();
                        $rsPeliculas = $db->executeQuery("SELECT id, nombre FROM peliculas");
                        while ($row = $rsPeliculas->fetch_assoc()) { 
                            echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                        }
                    ?>
                </select>
                <br>
                <label for="sucursal">Sucursal:</label>
                <select id="sucursal" name="sucursal">
                    <option value="">Selecciona una sucursal</option>
                    <?php 
                        $rsSucursales = $db->executeQuery("SELECT id, nombre FROM sucursales");
                        while ($row = $rsSucursales->fetch_assoc()) { 
                            echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                        }
                    ?>
                </select>
                <br>
                <label for="asiento">Asiento:</label>
                <select id="asiento" name="asiento">
                    <?php 
                        $rsAsientos = $db->executeQuery("SELECT id FROM asientos");
                        while ($row = $rsAsientos->fetch_assoc()) { 
                            echo "<option value='".$row['id']."'>".$row['id']."</option>";
                        }
                    ?>
                </select>
                <br>
                <input type="submit" value="Comprar Boleto">
            </form>
            <a href="home.html" class="homebtn">Ir a la página principal</a>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $pelicula = $_POST['pelicula'];
                    $sucursal = $_POST['sucursal'];
                    $asiento = $_POST['asiento'];

                    $query = "INSERT INTO boletos (pelicula_id, sucursal_id, asiento_numero) VALUES (?, ?, ?)";
                    $stmt = $db->conn->prepare($query);
                    $stmt->bind_param("iii", $pelicula, $sucursal, $asiento);
                    $result = $stmt->execute();

                    if ($result) {
                        $boleto_id = $db->conn->insert_id; // Obtener el ID del boleto recién insertado

                        // Consultar la información del boleto
                        $query_info = "SELECT b.id, p.nombre AS pelicula, s.nombre AS sucursal, b.asiento_numero 
                                       FROM boletos b 
                                       JOIN peliculas p ON b.pelicula_id = p.id 
                                       JOIN sucursales s ON b.sucursal_id = s.id 
                                       WHERE b.id = ?";
                        $stmt_info = $db->conn->prepare($query_info);
                        $stmt_info->bind_param("i", $boleto_id);
                        $stmt_info->execute();
                        $result_info = $stmt_info->get_result();

                        if ($result_info->num_rows > 0) {
                            $boleto = $result_info->fetch_assoc();
                            echo "<p>Boleto comprado con éxito!</p>";
                            echo "<p>ID de Boleto: " . $boleto['id'] . "</p>";
                            echo "<p>Película: " . $boleto['pelicula'] . "</p>";
                            echo "<p>Sucursal: " . $boleto['sucursal'] . "</p>";
                            echo "<p>Asiento: " . $boleto['asiento_numero'] . "</p>";
                        } else {
                            echo "<p>Error al obtener la información del boleto.</p>";
                        }
                    } else {
                        echo "<p>Error al comprar el boleto</p>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
