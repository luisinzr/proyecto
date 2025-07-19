<?php
session_start();
require_once("../config/conexion.php");
require_once("../modelo/PedidoSeleccionado.php");

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol_id'] != 1) {
    echo "Acceso no autorizado.";
    exit();
}

$usuario = $_SESSION['usuario'];
$pedidos = PedidoSeleccionado::obtenerTodos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Administrador - Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="../css/inicio-estilos.css">
</head>

  
  
<body>
 <body class="admin-page"> 
<div class="container mt-4">
  <h3 style="color: darkred; font-size: 35px;">Eliminar Pedidos de los Clientes </h3>

  <?php if ($pedidos->num_rows === 0): ?>
    <p>No hay pedidos registrados.</p>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Plato</th>
          <th>Cantidad</th>
          <th>Estado</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($pedido = $pedidos->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($pedido['nombre_usuario']) ?></td>
            <td><?= htmlspecialchars($pedido['nombre_plato']) ?></td>
            <td><?= $pedido['cantidad'] ?></td>
            <td><?= $pedido['estado'] ?></td>
            <td>
              <form method="POST" action="../controlador/eliminar_pedido.php" onsubmit="return confirm('¿Deseas eliminar este pedido?')">
                <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
                <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <a href="dashboard.php" class="btn btn-secondary mt-3">← Volver</a>
</div>
</body>
</html>




