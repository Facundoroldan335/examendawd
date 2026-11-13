<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}
$rol = $_SESSION["rol"];
require "conexion.php";
$consulta = $conexion->query("SELECT * FROM autos");
$autos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodados Del sudeste</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Rodados Del Sudeste</h1>
    <h1>Venta de Autos</h1>
    <a href="logout.php">Cerrar sesión</a>
    <?php if ($rol == "admin"): ?>
    <div class="form-auto">
        <h2>Agregar auto</h2>
        <form action="guardar.php" method="POST">
            <label>Nombre del auto:</label>
            <input type="text" name="nombre" required>
            <label>Año:</label>
            <input type="number" name="año" required>
            <label>Precio:</label>
            <input type="number" name="precio" required>
            <label>Descripción:</label>
            <textarea name="descripcion" required></textarea>
            <label>Foto:</label>
            <input type="text" name="foto">
            <button type="submit">Agregar auto</button>
        </form>
    </div>
    <hr>
    <?php endif; ?>
    <h2>Autos disponibles</h2>
    <?php foreach ($autos as $auto): ?>
    <div class="auto-card">
        <div class="auto-imagen">
            <?php if (!empty($auto["foto"])): ?>
                <img src="<?= htmlspecialchars($auto["foto"], ENT_QUOTES, "UTF-8") ?>" width="250" alt="Foto del auto">
            <?php endif; ?>
        </div>
        <div class="auto-info">
            <h2><?= htmlspecialchars($auto["nombre"], ENT_QUOTES, "UTF-8") ?> (<?= htmlspecialchars($auto["año"], ENT_QUOTES, "UTF-8") ?>)</h2>
            <p><strong>Precio:</strong> $<?= htmlspecialchars($auto["precio"], ENT_QUOTES, "UTF-8") ?></p>
            <p><strong>Descripción:</strong> <?= htmlspecialchars($auto["descripcion"], ENT_QUOTES, "UTF-8") ?></p>
            <a href="auto.php?id=<?= (int)$auto["id"] ?>">Ver auto</a>
            <?php if ($rol == "admin"): ?>
                <br><br>
                <a href="editar.php?id=<?= (int)$auto["id"] ?>">Editar</a>
                <form action="eliminar.php" method="POST">
                    <input type="hidden" name="id" value="<?= (int)$auto["id"] ?>">
                    <button type="submit">Eliminar</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>