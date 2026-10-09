<?php

require "conexion.php";
require "auth.php";

if (!esta_autenticado()) {
    header("Location: login.php");
    exit();
}

es_admin();

$nombre = $_POST["nombre"] ?? "";
$año = $_POST["año"] ?? "";
$descripcion = trim($_POST["descripcion"] ?? "");
$precio = $_POST["precio"] ?? "";
$foto = trim($_POST["foto"] ?? "");

if ($nombre === "" || $año === "" || $descripcion === "" || $precio === "") {
    header("Location: index.php?error=campos");
    exit();
}

$sql = "INSERT INTO autos (nombre, año, descripcion, precio, foto)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    $nombre,
    $año,
    $descripcion,
    $precio,
    $foto
]);
header("Location: index.php?res=agregado");
exit();