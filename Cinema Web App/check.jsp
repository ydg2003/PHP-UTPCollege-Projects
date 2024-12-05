<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        input[type=text], input[type=password] {
            width: 100%; /* Ajusta el ancho como prefieras */
            padding: 12px 20px; /* Aumenta el tamaño del campo */
            margin: 8px 0; /* Espaciado entre campos */
            display: inline-block;
            border: 1px solid #ccc; /* Borde del campo */
            border-radius: 4px; /* Bordes redondeados */
            box-sizing: border-box; /* Para que el padding no afecte el ancho total */
        }
        input[type=submit], button {
            width: 100%; /* Ajusta el ancho como prefieras */
            background-color: #0033FF; /* Color de fondo */
            color: white; /* Color de texto */
            padding: 14px 20px; /* Aumenta el tamaño del botón */
            margin: 8px 0; /* Espaciado entre botones */
            border: none; /* Sin borde */
            border-radius: 4px; /* Bordes redondeados */
            cursor: pointer; /* Cursor en forma de mano al pasar sobre el botón */
        }
        .homebtn {
            background-color: #4CAF50; /* Color de fondo diferente para el botón de home */
        }
    </style>
</head>
<body>
<div class="bg">
    <div class="container">
        <!-- Reemplaza 'url_tu_logo' con la URL de tu logo -->
        <img src="logocine.png" alt="Logo" class="logo">
        
        <% 
            // Captura de los valores que vienen desde el formulario.
            String username = request.getParameter("username");
            String password = request.getParameter("password");

            // Creamos la conexión
            try {
                Class.forName("com.mysql.jdbc.Driver");
                Connection dbconection = DriverManager.getConnection("jdbc:mysql://localhost:3306/cine","root","");
                Statement state = dbconection.createStatement();

                // Prepared Statement para proteger de SQL injection
                PreparedStatement preparado = dbconection.prepareStatement("SELECT * FROM usuarios WHERE username=? AND password=?");
                preparado.setString(1, username);
                preparado.setString(2, password);

                // Ejecutamos consulta y obtenemos un ResultSet
                ResultSet resultados = preparado.executeQuery();

                // Recorremos el ResultSet para ver si NO está vacío.
                String msg;
                if (resultados.next()) {
                    msg = "<h1 style='color: green;'>FELICIDADES, USUARIO CORRECTO</h1>";
                } else {
                    msg = "<h1 style='color: red;'>****ERROR*** <br> USUARIO INCORRECTO</h1>";
                }

                out.println(msg);
            } catch (ClassNotFoundException e) {
                out.println("Error: no se pudo cargar el controlador de la base de datos.");
                e.printStackTrace();
            } catch (SQLException e) {
                out.println("Error: no se pudo establecer la conexión con la base de datos.");
                e.printStackTrace();
            }
        %>
        
        <button type="button" class="homebtn" onclick="window.location.href='home.html';">Inicio</button>
        
    </div>
</div>
</body>
</html>
