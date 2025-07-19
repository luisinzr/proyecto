<?php
session_start();
require_once("../config/conexion.php");
require_once("../modelo/PedidoSeleccionado.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$rol_id = $_SESSION['usuario']['rol_id'];

// Si el camarero envía usuario_id para asignar pedido a un cliente
if ($rol_id == 3 && isset($_POST['usuario_id']) && !empty($_POST['usuario_id'])) {
    $usuario_id = intval($_POST['usuario_id']);
} else {
    // Para clientes o cualquier otro rol, el pedido es para sí mismo
    $usuario_id = $_SESSION['usuario']['id'];
}

$plato_id = $_POST['plato_id'];
$cantidad = $_POST['cantidad'];

PedidoSeleccionado::insertar($conexion, $usuario_id, $plato_id, $cantidad);
header("Location: ../vista/menu_cliente.php");
exit();
?>
