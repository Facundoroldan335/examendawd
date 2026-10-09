<?php
require "conexion.php";
session_start();
$consulta = $conexion->query("SELECT * FROM autos");
$autos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodados Del sudeste</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <h1>Rodados Del Sudeste</h1>
    <h1>Venta de Autos</h1>
<a href="logout.php">Cerrar sesión</a>
<?php if ($_SESSION["rol"] == "admin"): ?>
    <h2>Agregar auto</h2>
    <form action="guardar.php" method="POST">
        <label>Nombre del auto:</label>
        <input type="text" name="nombre" required>
        <br><br>
        <label>Año:</label>
        <input type="number" name="año" required>
        <br><br>
        <label>Precio:</label>
        <input type="number" name="precio" required>
        <br><br>
        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>
        <br><br>
        <label>Foto:</label>
        <input type="text" name="foto">
        <br><br>
        <button type="submit">Agregar auto</button>
    </form>
    <hr>
<?php endif; ?>
<h2>Autos disponibles</h2>
<?php foreach ($autos as $auto): ?>
    <div>
        <h2><?= $auto["nombre"] ?> (<?= $auto["año"] ?>)</h2>
        <p><strong>Precio:</strong> $<?= $auto["precio"] ?></p>
        <p><strong>Descripción:</strong> <?= $auto["descripcion"] ?></p>
        <?php if (!empty($auto["foto"])): ?>
            <img src="<?= $auto["foto"] ?>" width="200">
        <?php endif; ?>
        <br><br>
        <a href="auto.php?id=<?= $auto["id"] ?>">Ver auto</a>
        <?php if ($_SESSION["rol"] == "admin"): ?>
            <br><br>
            <a href="editar.php?id=<?= $auto["id"] ?>">Editar</a>
            <form action="eliminar.php" method="POST">
                <input type="hidden" name="id" value="<?= $auto["id"] ?>">
                <button type="submit">Eliminar</button>
            </form>
        <?php endif; ?>
    </div>
    <hr>
<?php endforeach; ?>
</body>
</html>