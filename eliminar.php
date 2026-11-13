
<?php
require "conexion.php";
require "auth.php";
requerir_rol("admin");
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}
$id = $_POST["id"] ?? "";
if (!filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
    header("Location: index.php");
    exit();
}
$sql = "DELETE FROM autos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);
header("Location: index.php?res=eliminado");
exit();
?>
