<?php
require_once("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM pedidos_seleccionados WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: ../vista/admin.php");
    exit();
}
?>
