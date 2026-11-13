
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registrate</h1>
    <h2>Crear Cuenta</h2>
    <div class="form">
        <form action="registroControler.php" method="POST">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required minlength="6">
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="">Seleccionar rol</option>
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <button type="submit">Registrarse</button>
        </form>
    </div>
    <p>¿Ya tenés cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>
</html>
