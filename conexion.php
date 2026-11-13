<?php
$host = getenv("DB_HOST") ?: "127.0.0.1";
$puerto = getenv("DB_PORT") ?: "3306";
$usuario = getenv("DB_USER") ?: "rodados_user";
$clave = getenv("DB_PASSWORD");
$basededatos = getenv("DB_NAME") ?: "rodados_del_sudeste";

if ($clave === false || $clave === "") {
    die("Error: falta configurar DB_PASSWORD en Render.");
}

try {
    $conexion = new PDO(
        "mysql:host=$host;port=$puerto;dbname=$basededatos;charset=utf8mb4",
        $usuario,
        $clave
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}
?>
