<?php
$host = getenv("DB_HOST") ?: "localhost";
$usuario = getenv("DB_USER") ?: "root";
$clave = getenv("DB_PASSWORD") ?: "";
$basededatos = getenv("DB_NAME") ?: "rodados_del_sudeste";
try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$basededatos;charset=utf8mb4",
        $usuario,
        $clave
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}
?>
