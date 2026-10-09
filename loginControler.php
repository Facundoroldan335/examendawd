<?php

session_start();

require "conexion.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";
if ($email === "" || $password === "") {
    header("Location: login.php?error=1");
    exit();
}
$sql = "SELECT id, email, password, rol FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$email]);

$usuario = $stmt->fetch();

if (!$usuario || !password_verify($password, $usuario["password"])) {
    header("Location: login.php?error=1");
    exit();
}

session_regenerate_id(true);

$_SESSION["id"] = $usuario["id"];
$_SESSION["email"] = $usuario["email"];
$_SESSION["rol"] = $usuario["rol"];

header("Location: index.php");
exit();