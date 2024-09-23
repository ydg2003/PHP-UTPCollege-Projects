<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Formulario de Registro al Evento Tecnológico</h1>
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

        <!-- Drop-down for País de Residencia -->
        <label for="pais_residencia">País de Residencia:</label>
        <select id="pais_residencia" name="pais_residencia" required>
            <option value="">Seleccione su país</option>
            <option value="Panamá">Panamá</option>
            <option value="Argentina">Argentina</option>
            <option value="Brasil">Brasil</option>
            <option value="Chile">Chile</option>
            <option value="Colombia">Colombia</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="México">México</option>
            <option value="Perú">Perú</option>
            <option value="España">España</option>
            <option value="Estados Unidos">Estados Unidos</option>
        </select><br><br>

        <!-- Drop-down for Nacionalidad -->
        <label for="nacionalidad">Nacionalidad:</label>
        <select id="nacionalidad" name="nacionalidad" required>
            <option value="">Seleccione su nacionalidad</option>
            <option value="Panameña">Panameña</option>
            <option value="Argentina">Argentina</option>
            <option value="Brasileña">Brasileña</option>
            <option value="Chilena">Chilena</option>
            <option value="Colombiana">Colombiana</option>
            <option value="Costarricense">Costarricense</option>
            <option value="Mexicana">Mexicana</option>
            <option value="Peruana">Peruana</option>
            <option value="Española">Española</option>
            <option value="Estadounidense">Estadounidense</option>
        </select><br><br>

        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label>Tema Tecnológico que le gustaría aprender:</label><br>
        <input type="checkbox" id="web" name="temas[]" value="Desarrollo web">
        <label for="web">Desarrollo web</label><br>

        <input type="checkbox" id="movil" name="temas[]" value="Desarrollo móvil">
        <label for="movil">Desarrollo móvil</label><br>

        <input type="checkbox" id="bd" name="temas[]" value="Base de datos">
        <label for="bd">Base de datos</label><br>

        <input type="checkbox" id="ia" name="temas[]" value="Inteligencia artificial">
        <label for="ia">Inteligencia artificial</label><br>

        <!-- Continue adding other topics... -->
        
        <label for="observaciones">Observaciones o Consulta sobre el evento:</label><br>
        <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea><br><br>

        <!-- Auto-set the current date using PHP -->
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