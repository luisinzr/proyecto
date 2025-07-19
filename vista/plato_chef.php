<?php
session_start();
require_once("../config/conexion.php");
require_once("../modelo/Plato.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$rol_id = $_SESSION['usuario']['rol_id'];

if ($rol_id != 2) { // Solo Chef
    echo "Acceso no autorizado.";
    exit();
}

$platos = Plato::obtenerTodos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Menú de Platos para Chef</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-4">
  <h3>📋 Menú de Platos (Vista para Chef)</h3>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nombre del Plato</th>
        <th>Descripción</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($plato = $platos->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($plato['nombre_plato']) ?></td>
          <td><?= htmlspecialchars($plato['descripcion']) ?></td>
          <td>$<?= number_format($plato['precio'], 2) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary mt-3">← Volver al Dashboard</a>
</div>
</body>
</html>

