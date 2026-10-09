<?php

$host = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "rodados_del_sudeste";

try{
    $conexion = new PDO(
        "mysql:host=$host;dbname=$basededatos;charset=utf8",
        $usuario,
        $clave
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}

?>