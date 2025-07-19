<?php
session_start();
require_once("../../config/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol_id'] != 1) {
    echo "Acceso no autorizado.";
    exit();
}

// Insertar nuevo plato
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "crear") {
    $nombre = $_POST["nombre_plato"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    $stmt = $conexion->prepare("INSERT INTO platos (nombre_plato, descripcion, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nombre, $descripcion, $precio);
    $stmt->execute();
    header("Location: gestion_platos.php");
    exit();
}

// Eliminar plato (con verificación de uso en pedidos)
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];

    // Verificar si el plato está en uso en pedidos
    $verificar = $conexion->query("SELECT COUNT(*) AS total FROM pedidos_seleccionados WHERE plato_id = $id");
    $row = $verificar->fetch_assoc();

    if ($row['total'] > 0) {
        echo "<script>alert('❌ No se puede eliminar el plato porque ya ha sido usado en pedidos.'); window.location='gestion_platos.php';</script>";
        exit();
    } else {
        $conexion->query("DELETE FROM platos WHERE id = $id");
        echo "<script>alert('✅ Plato eliminado correctamente.'); window.location='gestion_platos.php';</script>";
        exit();
    }
}

// Obtener todos los platos
$platos = $conexion->query("SELECT * FROM platos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Platos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/inicio-estilos.css">
</head>
<body class="gestor-platos">

<div class="container mt-4">
  <h3>🍽️ Gestión de Platos</h3>

  <form method="POST" class="row g-3 mb-4">
    <input type="hidden" name="accion" value="crear">
    <div class="col-md-3">
      <input type="text" name="nombre_plato" class="form-control" placeholder="Nombre del plato" required>
    </div>
    <div class="col-md-5">
      <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
    </div>
    <div class="col-md-2">
      <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100">➕ Crear Plato</button>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while($plato = $platos->fetch_assoc()): ?>
        <tr>
          <td><?= $plato['id'] ?></td>
          <td><?= htmlspecialchars($plato['nombre_plato']) ?></td>
          <td><?= htmlspecialchars($plato['descripcion']) ?></td>
          <td>$<?= $plato['precio'] ?></td>
          <td>
            <a href="editar_plato.php?id=<?= $plato['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar plato</a>
            <a href="gestion_platos.php?eliminar=<?= $plato['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este plato?')">🗑️ Eliminar plato</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="../dashboard.php" class="btn btn-secondary mt-3">← Volver al Panel</a>
</div>

</body>
</html>
