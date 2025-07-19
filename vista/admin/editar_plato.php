<?php
session_start();
require_once("../../config/conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol_id'] != 1) {
    echo "Acceso no autorizado.";
    exit();
}

// Verificar si llegó el ID del plato por GET
if (!isset($_GET['id'])) {
    echo "ID del plato no especificado.";
    exit();
}

$plato_id = $_GET['id'];
$mensaje = "";

// Obtener datos actuales del plato
$sql = "SELECT * FROM platos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $plato_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Plato no encontrado.";
    exit();
}

$plato = $resultado->fetch_assoc();

// Actualizar datos si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre_plato'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $sql = "UPDATE platos SET nombre_plato = ?, descripcion = ?, precio = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $plato_id);

    if ($stmt->execute()) {
        $mensaje = "✅ Plato actualizado correctamente.";
        // Refrescar los datos del plato
        $stmt = $conexion->prepare("SELECT * FROM platos WHERE id = ?");
        $stmt->bind_param("i", $plato_id);
        $stmt->execute();
        $plato = $stmt->get_result()->fetch_assoc();
    } else {
        $mensaje = "❌ Error al actualizar el plato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Plato</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>✏️ Editar Plato</h3>

  <?php if ($mensaje): ?>
    <div class="alert alert-info"><?= $mensaje ?></div>
  <?php endif; ?>

  <form method="POST" class="mb-4">
    <div class="mb-3">
      <label for="nombre_plato" class="form-label">Nombre del plato</label>
      <input type="text" name="nombre_plato" class="form-control" required value="<?= htmlspecialchars($plato['nombre_plato']) ?>">
    </div>
    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control"><?= htmlspecialchars($plato['descripcion']) ?></textarea>
    </div>
    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" step="0.01" name="precio" class="form-control" required value="<?= $plato['precio'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
    <a href="gestion_platos.php" class="btn btn-secondary">← Volver</a>
  </form>
</div>
</body>
</html>
