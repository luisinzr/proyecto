<?php 
session_start();
require_once("../config/conexion.php");
require_once("../modelo/Plato.php");
require_once("../modelo/PedidoSeleccionado.php");
require_once("../modelo/Usuario.php"); // Para obtener lista de clientes

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$rol_id = $_SESSION['usuario']['rol_id'];

// Validar que solo los roles 1 a 4 puedan acceder
if (!in_array($rol_id, [1, 2, 3, 4])) {
    echo "Acceso no autorizado.";
    exit();
}

$platos = Plato::obtenerTodos($conexion);
$pedidos = PedidoSeleccionado::obtenerPorUsuario($conexion, $usuario_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú del Restaurante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/inicio-estilos.css">
</head>
<body>
    <body class="menu-cliente-page">
<div class="container mt-4">
  <h3>📋 Menú</h3>

  <!-- Solo Cliente y Camarero pueden hacer pedidos -->
  <?php if (in_array($rol_id, [3, 4])): ?>
  <form action="../controlador/PedidoControlador.php" method="POST" class="row g-3 mb-4">

  
    
    <?php if ($rol_id == 3): // Si es camarero, elegir cliente ?>
    <div class="col-md-4">
      <label class="form-label">Seleccionar Cliente</label>
      <select name="usuario_id" class="form-select" required>
        <option value="">Seleccione un cliente</option>
        <?php
          $clientes = Usuario::obtenerClientes($conexion);
          while ($cliente = $clientes->fetch_assoc()):
        ?>
          <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nombre_usuario']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <?php endif; ?>

    <div class="col-md-<?= $rol_id == 3 ? '4' : '6' ?>">
      <label class="form-label">Plato</label>
      <select name="plato_id" class="form-select" required>
        <option value="">Seleccione un plato</option>
        <?php 
          mysqli_data_seek($platos, 0); // reiniciar el puntero por si ya fue leído
          while($plato = $platos->fetch_assoc()): ?>
          <option value="<?= $plato['id'] ?>"><?= $plato['nombre_plato'] ?> - $<?= $plato['precio'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Cantidad</label>
      <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required min="1">
    </div>

    <div class="col-md-2 d-grid">
      <label class="form-label">&nbsp;</label>
      <button type="submit" class="btn btn-success">🛒 Agregar</button>
    </div>

    <?php if ($rol_id == 3): ?>
      <input type="hidden" name="desde_camarero" value="1">
    <?php endif; ?>
  </form>
  <?php endif; ?>

  <h4>🧾 Tus pedidos</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Plato</th>
        <th>Cantidad</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php while($pedido = $pedidos->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($pedido['nombre_plato']) ?></td>
          <td><?= $pedido['cantidad'] ?></td>
          <td><?= $pedido['estado'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary mt-3">← Volver</a>
</div>
</body>
</html>
