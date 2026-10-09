<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "conexion.php";
require "auth.php";

if (!esta_autenticado()) {
    header("Location: login.php");
    exit();
}
es_admin();
$id = $_GET["id"] ?? "";
if ($id === "") {
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
</head>
<link rel="stylesheet" href="style.css">
<body>
    <h1>Editar Vehículo</h1>
    <form action="actulizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $vehiculo["id"]; ?>"> 
    <label>Precio:</label>
    <input type="number" name="precio" value="<?php echo $vehiculo["precio"]; ?>"> 
    <label>Descripción:</label>
    <textarea name="descripcion"><?php echo $vehiculo["descripcion"]; ?></textarea> 
    <label>Foto:</label>
    <input type="text" name="foto" value="<?php echo $vehiculo["foto"]; ?>"> 
    <button type="submit">Guardar cambios</button>
    </form>
    <a href="index.php">Volver</a>
</body>
</html>