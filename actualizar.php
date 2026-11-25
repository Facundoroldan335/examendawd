<?php
require "auth.php";
require "conexion.php";

requerir_rol("admin");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$id = $_POST["id"] ?? "";
$nombre = trim($_POST["nombre"] ?? "");
$año = $_POST["año"] ?? "";
$precio = $_POST["precio"] ?? "";
$descripcion = trim($_POST["descripcion"] ?? "");
$foto = trim($_POST["foto"] ?? "");

if ($id === "" || $nombre === "" || $año === "" || $precio === "" || $descripcion === "") {
    die("Todos los campos obligatorios deben completarse");
}

if (!filter_var($id, FILTER_VALIDATE_INT) || $id <= 0 || !filter_var($año, FILTER_VALIDATE_INT) || $año <= 0 || !is_numeric($precio) || $precio < 0) {
    die("Los datos ingresados no son válidos");
}

$sql = "UPDATE autos SET nombre = ?, año = ?, precio = ?, descripcion = ?, foto = ? WHERE id = ?";

$consulta = $conexion->prepare($sql);
$consulta->execute([$nombre, $año, $precio, $descripcion, $foto, $id]);

header("Location: index.php?res=actualizado");
exit();
