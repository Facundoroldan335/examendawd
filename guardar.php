<?php
require "conexion.php";
require "auth.php";
requerir_rol("admin");
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}
$nombre = trim($_POST["nombre"] ?? "");
$año = $_POST["año"] ?? "";
$descripcion = trim($_POST["descripcion"] ?? "");
$precio = $_POST["precio"] ?? "";
$foto = trim($_POST["foto"] ?? "");
if ($nombre === "" || $año === "" || $descripcion === "" || $precio === "") {
    header("Location: index.php?error=campos");
    exit();
}
if (!filter_var($año, FILTER_VALIDATE_INT) || $año <= 0 || !is_numeric($precio) || $precio < 0) {
    header("Location: index.php?error=datos");
    exit();
}
$sql = "INSERT INTO autos (nombre, año, descripcion, precio, foto) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$nombre, $año, $descripcion, $precio, $foto]);
header("Location: index.php?res=agregado");
exit();
?>
