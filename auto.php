<?php
require "auth.php";
require "conexion.php";
requerir_autenticacion();

$id = $_GET["id"] ?? null;

if (!$id || !is_numeric($id)) {
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Detalle del auto</h1>
    <div class="auto-card">
        <div class="auto-imagen">
            <?php if (!empty($auto["foto"])): ?>
                <img src="<?php echo htmlspecialchars($auto["foto"], ENT_QUOTES, "UTF-8"); ?>"
                     alt="Foto del vehículo"
                     width="400">
            <?php endif; ?>
        </div>
        <div class="auto-info">
            <h2>
                <?php echo htmlspecialchars($auto["nombre"], ENT_QUOTES, "UTF-8"); ?>
                (<?php echo htmlspecialchars($auto["año"], ENT_QUOTES, "UTF-8"); ?>)
            </h2>
            <p>
                <strong>Precio:</strong>
                $<?php echo htmlspecialchars($auto["precio"], ENT_QUOTES, "UTF-8"); ?>
            </p>
            <p>
                <strong>Descripción:</strong>
                <?php echo htmlspecialchars($auto["descripcion"], ENT_QUOTES, "UTF-8"); ?>
            </p>
        </div>
    </div>
    <a href="index.php">Volver a los autos</a>
</body>
</html>
