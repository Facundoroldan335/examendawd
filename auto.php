<?php
require "auth.php";
require "conexion.php";
requerir_autenticacion();
$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit();
}

$consulta = $conexion->prepare("SELECT * FROM autos WHERE id = ?");
$consulta->execute([$id]);
$auto = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$auto) {
    echo "Auto no encontrado";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del auto</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <h1>Detalle del auto</h1>
    <h2><?= $auto["nombre"] ?> (<?= $auto["año"] ?>)</h2>
    <p><strong>Precio:</strong> $<?= $auto["precio"] ?></p>
    <p><strong>Descripción:</strong> <?= $auto["descripcion"] ?></p>
    <?php if (!empty($auto["foto"])): ?>
        <img src="<?= $auto["foto"] ?>" alt="Foto de <?= $auto["nombre"] ?>" width="400">
    <?php endif; ?>
    <br><br>
    <a href="index.php">Volver a los autos</a>
</body>
</html>
