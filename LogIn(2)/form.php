<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Formulario de Registro al Evento Tecnológico</h1>

    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'evento');

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Fetch countries and nationalities from the database
    $sql = "SELECT pais_residencia, nacionalidad FROM paises_y_nacionalidades";
    $result = $conn->query($sql);
    
    $countries = [];
    $nationalities = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $countries[] = $row['pais_residencia'];
            $nationalities[] = $row['nacionalidad'];
        }
    }
    $conn->close();
    ?>

    <form action="variable.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" min="1" max="99" required><br><br>

        <label>Sexo:</label><br>
        <input type="radio" id="masculino" name="sexo" value="Masculino" required>
        <label for="masculino">Masculino</label><br>
        <input type="radio" id="femenino" name="sexo" value="Femenino" required>
        <label for="femenino">Femenino</label><br><br>

        <label for="pais_residencia">País de Residencia:</label>
        <select id="pais_residencia" name="pais_residencia" required>
            <option value="">Seleccione su país</option>
            <?php
            foreach ($countries as $pais) {
                echo "<option value=\"$pais\">$pais</option>";
            }
            ?>
        </select><br><br>

        <label for="nacionalidad">Nacionalidad:</label>
        <select id="nacionalidad" name="nacionalidad" required>
            <option value="">Seleccione su nacionalidad</option>
            <?php
            foreach ($nationalities as $nacionalidad) {
                echo "<option value=\"$nacionalidad\">$nacionalidad</option>";
            }
            ?>
        </select><br><br>

        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <!-- Updated section with all the requested technology topics -->
        <label>Tema Tecnológico que le gustaría aprender:</label><br>
        <input type="checkbox" id="web" name="temas[]" value="Desarrollo web">
        <label for="web">Desarrollo web</label><br>

        <input type="checkbox" id="movil" name="temas[]" value="Desarrollo móvil">
        <label for="movil">Desarrollo móvil</label><br>

        <input type="checkbox" id="bd" name="temas[]" value="Base de datos">
        <label for="bd">Base de datos</label><br>

        <input type="checkbox" id="ia" name="temas[]" value="Inteligencia artificial">
        <label for="ia">Inteligencia artificial</label><br>

        <input type="checkbox" id="seguridad" name="temas[]" value="Seguridad informática">
        <label for="seguridad">Seguridad informática</label><br>

        <input type="checkbox" id="devops" name="temas[]" value="DevOps">
        <label for="devops">DevOps</label><br>

        <input type="checkbox" id="iot" name="temas[]" value="Internet de las cosas">
        <label for="iot">Internet de las cosas</label><br>

        <input type="checkbox" id="blockchain" name="temas[]" value="Blockchain">
        <label for="blockchain">Blockchain</label><br>

        <input type="checkbox" id="data" name="temas[]" value="Ciencia de datos">
        <label for="data">Ciencia de datos</label><br>

        <input type="checkbox" id="robotica" name="temas[]" value="Robótica">
        <label for="robotica">Robótica</label><br>

        <input type="checkbox" id="rvra" name="temas[]" value="Realidad virtual/aumentada">
        <label for="rvra">Realidad virtual/aumentada</label><br>

        <input type="checkbox" id="programacion" name="temas[]" value="Programación">
        <label for="programacion">Programación</label><br><br>

        <label for="observaciones">Observaciones o Consulta sobre el evento:</label><br>
        <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea><br><br>

        <label for="fecha">Fecha del Formulario:</label>
        <input type="text" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br><br>

        <input type="submit" value="Enviar">
    </form>

    <footer>
        <p>Universidad Tecnológica de Panamá - <?php echo date('Y'); ?></p>
        <p>Dirección: Avenida Universidad Tecnológica de Panamá, Vía Puente Centenario, Campus Metropolitano Víctor Levi Sasso.</p>
        <p>Teléfono: (507) 560-3000</p>
        <p>Correo electrónico: buzondesugerencias@utp.ac.pa</p>
        <p>© <?php echo date('Y'); ?> YforG Inc. All rights reserved.</p>
    </footer>
</body>
</html>