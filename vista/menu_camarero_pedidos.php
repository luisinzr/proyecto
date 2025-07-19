<?php
session_start();
require_once("../config/conexion.php");
require_once("../modelo/Plato.php");
require_once("../modelo/Usuario.php");

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol_id'] != 3) {
    header("Location: ../index.php");
    exit();
}

$camarero_id = $_SESSION['usuario']['id'];
$platos = Plato::obtenerTodos($conexion);
$clientes = Usuario::obtenerClientes($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pedido por Camarero</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>🍽️ Realizar pedido para un cliente</h3>

  <form action="../controlador/PedidoCamareroControlador.php" method="POST" class="row g-3">
    <input type="hidden" name="camarero_id" value="<?= $camarero_id ?>">

    <div class="col-md-4">
      <label class="form-label">Cliente</label>
      <select name="cliente_id" class="form-select" required>
        <option value="">Seleccione un cliente</option>
        <?php while ($cliente = $clientes->fetch_assoc()): ?>
          <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nombre_usuario']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Plato</label>
      <select name="plato_id" class="form-select" required>
        <option value="">Seleccione un plato</option>
        <?php while ($plato = $platos->fetch_assoc()): ?>
          <option value="<?= $plato['id'] ?>"><?= $plato['nombre_plato'] ?> - $<?= $plato['precio'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Cantidad</label>
      <input type="number" name="cantidad" class="form-control" required min="1">
    </div>

    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" class="btn btn-success w-100">Agregar</button>
    </div>
  </form>

  <a href="dashboard.php" class="btn btn-secondary mt-3">← Volver</a>
</div>
</body>
</html>
