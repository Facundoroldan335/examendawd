<?php
session_start();
function esta_autenticado() {
    if(isset($_SESSION["id"])) {
        return true;
    }
    return false;
}

function es_admin() {
    return esta_autenticado() && isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";
}
function requerir_autenticacion() {
    if(!esta_autenticado()) {
        header("Location: login.php");
        exit();
    }
}
function requerir_rol($rol_esperado) {
    if(!esta_autenticado()) {
        header("Location: login.php");
        exit();
    }
    if($_SESSION["rol"] != $rol_esperado) {
        http_response_code(403);
        echo "403 - No tenes permisos para acceder a esta pagina.";
        exit();
    }
}
?>