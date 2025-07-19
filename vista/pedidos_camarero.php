<?php
session_start();
require_once("../config/conexion.php");
// require_once("../modelo/PedidoSeleccionado.php"); // Opcional si no usas su función

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Acceso permitido solo a roles 1,2,3,4
if (!in_array($usuario['rol_id'], [1, 2, 3, 4])) {
    echo "Acceso no autorizado.";
    exit();
}

// Actualizar estado si se recibe POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pedido_id = $_POST['pedido_id'];
    $nuevo_estado = $_POST['estado'];

    $sql = "UPDATE pedidos_camarero SET estado = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nuevo_estado, $pedido_id);
    $stmt->execute();
    header("Location: pedidos_camarero.php");
    exit();
}

// Obtener pedidos desde pedidos_camarero
$pedidos = $conexion->query("SELECT id, nombre_cliente AS nombre_usuario, nombre_plato, cantidad, estado FROM pedidos_camarero ORDER BY fecha_pedido DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Pedidos Asignados - Camarero</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-4">
  <h3>📦 Pedidos realizados por Clientes</h3>

  <?php if ($pedidos->num_rows === 0): ?>
    <p>No hay pedidos realizados por los clientes aún.</p>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Plato</th>
          <th>Cantidad</th>
          <th>Estado actual</th>
          <th>Actualizar estado</th>
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
              <form method="POST" style="margin-bottom:0;">
                <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
                <select name="estado" class="form-select" onchange="this.form.submit()">
                  <?php
                  $estados = ['Pendiente', 'En preparación', 'Listo para servir', 'Servido'];
                  foreach ($estados as $estado) {
                      $selected = ($estado == $pedido['estado']) ? 'selected' : '';
                      echo "<option value='$estado' $selected>$estado</option>";
                  }
                  ?>
                </select>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <a href="dashboard.php" class="btn btn-secondary mt-3">← Volver al menú principal</a>
</div>
</body>
</html>
