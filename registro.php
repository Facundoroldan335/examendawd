<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "conexion.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <h1>Registrate</h1>
    <h2>Crear Cuenta</h2>
    <div class="form">
        <form action="registroControler.php" method="POST">
        <label for="email">Correo Electronico:</label>
        <br><br>
        <input type="email" id="email" name="email">
        <br><br>
        <label for="password">Contraseña:</label>
        <br><br>
        <input type="password" name="password" id="password">
        <br><br>
        <label for="rol">Rol:</label>
        <br><br>
        <input type="text" id="rol" name="rol">
        <br><br>
        <button type="submit">Registrate</button>
        </form>
    </div>
    <p>¿Ya tienes cuentar?<a href="login.php">Iniciar Sesion</a></p>
</body>
</html>