<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <h1>Bienvenido a Rodados del Sudeste</h1>
    <h2>Iniciar Sesion</h2>
    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso'): ?>
        <p>Registro exitoso. Ahora podés <a href="login.php">iniciar sesion.</a></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p>Correo o contraseña incorrectos.</p>
    <?php endif; ?>
    <div class="form">
        <form action="loginControler.php" method="POST">
        <label for="email">Correo Electronico</label>
        <br><br>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Contraseña</label>
        <br><br>
        <input type="password" id="password" name="password">
        <br><br>
        <button type="submit">Iniciar Sesion</button>
        </form>
    </div>
    <p>¿No tenes cuenta?<a href="registro.php">Registrate</a></p>
</body>
</html>