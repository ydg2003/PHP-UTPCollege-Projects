<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
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
        .message {
            margin-top: 20px;
            text-align: center;
        }
        button {
            width: 100%;
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
        
        <div class="message">
            <%
                String firstname = request.getParameter("firstname");
                String lastname = request.getParameter("lastname");
                String email = request.getParameter("email");
                String phone = request.getParameter("phone");
                String username = request.getParameter("username");
                String password = request.getParameter("password");

                Connection conn = null;
                PreparedStatement pstmt = null;

                try {
                    Class.forName("com.mysql.jdbc.Driver");
                    conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/cine", "root", "");

                    String sql = "INSERT INTO usuarios (firstname, lastname, email, phone, username, password) VALUES (?, ?, ?, ?, ?, ?)";
                    pstmt = conn.prepareStatement(sql);
                    pstmt.setString(1, firstname);
                    pstmt.setString(2, lastname);
                    pstmt.setString(3, email);
                    pstmt.setString(4, phone);
                    pstmt.setString(5, username);
                    pstmt.setString(6, password);

                    int rows = pstmt.executeUpdate();

                    if (rows > 0) {
                        out.println("<h1 style='color: green;'>Registro exitoso</h1>");
                    } else {
                        out.println("<h1 style='color: red;'>Error en el registro</h1>");
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                    out.println("<h1 style='color: red;'>Error en el registro</h1>");
                } finally {
                    try {
                        if (pstmt != null) pstmt.close();
                        if (conn != null) conn.close();
                    } catch (SQLException e) {
                        e.printStackTrace();
                    }
                }
            %>
        </div>
        
        <button type="button" class="homebtn" onclick="window.location.href='home.html';">Inicio</button>
        
    </div>
</div>
</body>
</html>
