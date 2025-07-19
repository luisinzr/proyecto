<?php
session_start();
require_once("../config/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol_id'] != 3) {
    header("Location: ../index.php");
    exit();
}

$camarero_id = $_POST['camarero_id'];
$cliente_id = $_POST['cliente_id'];
$plato_id = $_POST['plato_id'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO pedidos_camarero (camarero_id, cliente_id, plato_id, cantidad) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iiii", $camarero_id, $cliente_id, $plato_id, $cantidad);
$stmt->execute();

header("Location: ../vista/menu_camarero_pedidos.php");
exit();
