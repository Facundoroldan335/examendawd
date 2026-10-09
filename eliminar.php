<?php
require "conexion.php";
require "auth.php";
if (!esta_autenticado()) {
    header("Location: login.php");
    exit();
}
es_admin();
$id = $_POST["id"] ?? "";
if ($id === "") {
    header("Location: index.php");
    exit();
}
$sql = "DELETE FROM autos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php?res=eliminado");
exit();
?>