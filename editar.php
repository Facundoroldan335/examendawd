<?php
require_once "auth.php";
require_once "conexion.php";

requerir_rol("admin");
$id = $_GET["id"] ?? "";
if (!filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
    header("Location: index.php");
    exit();
}
$sql = "SELECT * FROM autos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);
$vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$vehiculo) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Vehículo</h1>
    <div class="form-auto">
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo (int)$vehiculo["id"]; ?>">
            <label>Nombre del auto:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($vehiculo["nombre"], ENT_QUOTES, "UTF-8"); ?>" required>
            <label>Año:</label>
            <input type="number" name="año" value="<?php echo (int)$vehiculo["año"]; ?>" required>
            <label>Precio:</label>
            <input type="number" name="precio" value="<?php echo htmlspecialchars($vehiculo["precio"], ENT_QUOTES, "UTF-8"); ?>" required>
            <label>Descripción:</label>
            <textarea name="descripcion" required><?php echo htmlspecialchars($vehiculo["descripcion"], ENT_QUOTES, "UTF-8"); ?></textarea>
            <label>Foto:</label>
            <input type="text" name="foto" value="<?php echo htmlspecialchars($vehiculo["foto"], ENT_QUOTES, "UTF-8"); ?>">
            <button type="submit">Guardar cambios</button>
        </form>
    </div>
    <a href="index.php">Volver</a>
</body>
</html>
