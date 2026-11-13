<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: registro.php");
    exit();
}
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";
$rol = $_POST["rol"] ?? "";
if ($email === "" || $password === "" || $rol === "") {
    die("Todos los campos son obligatorios.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}
if (strlen($password) < 6) {
    die("La contraseña debe tener al menos 6 caracteres.");
}
if ($rol !== "admin" && $rol !== "usuario") {
    die("El rol seleccionado no es válido.");
}
$consulta = $conexion->prepare(
    "SELECT id FROM usuarios WHERE email = ?"
);
$consulta->execute([$email]);
if ($consulta->fetch()) {
    die("Ese correo ya está registrado.");
}
$hashContrasenia = password_hash($password, PASSWORD_DEFAULT);
$consulta = $conexion->prepare(
    "INSERT INTO usuarios (email, password, rol)
     VALUES (?, ?, ?)"
);
$consulta->execute([
    $email,
    $hashContrasenia,
    $rol
]);
header("Location: login.php?registro=exitoso");
exit();
?>
