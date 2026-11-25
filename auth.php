<?php
session_start();

function esta_autenticado() {
    return isset($_SESSION["id"]);
}

function es_admin() {
    return esta_autenticado() && isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";
}

function requerir_autenticacion() {
    if (!esta_autenticado()) {
        header("Location: login.php");
        exit();
    }
}

function requerir_rol($rol_esperado) {
    requerir_autenticacion();

    if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== $rol_esperado) {
        http_response_code(403);
        exit("403 - No tenes permisos para acceder a esta pagina.");
    }
}