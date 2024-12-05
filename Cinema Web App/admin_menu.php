<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Administrador</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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

        .menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 150px;
            background-color: #0000ff;
            color: white;
            text-decoration: none;
            border-radius: 15px;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #3366ff;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="logocine.png" alt="Logo">
    </div>
    <h1>Menú de Administrador</h1>
    <div class="menu">
        <a href="administrar_usuarios.php" class="menu-item">Administrar Usuarios</a>
        <a href="administrar_boletos.php" class="menu-item">Administrar Boletos</a>
    </div>
</body>
</html>
