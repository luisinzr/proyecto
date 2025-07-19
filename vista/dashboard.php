<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
$usuario = $_SESSION['usuario'];
$rol_id = $usuario['rol_id'];
$roles = [1 => 'Administrador', 2 => 'Chef', 3 => 'Camarero', 4 => 'Cliente'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/inicio-estilos.css"> 

</head>
<body class="dashboard-page">
  <h2>Bienvenido, <?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h2>
  <h5>Rol: <strong><?php echo $roles[$rol_id]; ?></strong></h5>
</body>
</html>

<body>
<body class="dashboard-page">
 

  <!-- Botón para ver menú y hacer pedido (para todos) -->
  <?php if ($_SESSION['usuario']['rol_id'] != 2): ?>
  <!-- Botón para ver menú y hacer pedido (para todos menos chef) -->
  <a href="menu_cliente.php" class="btn btn-primary mt-3 mb-4">📋 Ver Menú y Hacer Pedido</a>
<?php endif; ?>

  <!-- Mostrar botones según rol -->
  <div>
<?php if ($_SESSION['usuario']['rol_id'] == 2): ?>
  <h5>Funciones Chef:</h5>
  <a href="pedidos_camarero.php" class="btn btn-info mb-2">VER Y ACTUALIZAR ESTADO DE PEDIDOS</a><br>
  <a href="plato_chef.php" class="btn btn-primary mb-2">Ver Menú (Solo Vista)</a><br>
<?php endif; ?>

    <?php if ($rol_id == 1): // Administrador ?>
  <h5>Funciones Administrador:</h5>
  <div style="width: 40%;">
  <a href="admin.php" class="btn btn-dark mb-2 w-100 text-start">🛠️ Eliminar Pedidos de los Clientes</a>
  <a href="admin/gestion_platos.php" class="btn btn-warning mb-2 w-100 text-start">Crear/Editar/Eliminar Platos</a>
</div>
   
    <?php elseif ($rol_id == 2): // Chef ?>
     
    <?php elseif ($rol_id == 3): // Camarero ?>
      <h5>Funciones Camarero:</h5>
      <a href="pedidos_camarero.php" class="btn btn-success mb-2">📦 Actualizar Estados</a>

    <?php elseif ($rol_id == 4): // Cliente ?>
  
<?php endif; ?>

  </div>

  <a href="../logout.php" class="btn btn-outline-danger mt-4">Cerrar Sesión</a>

  <!-- Mostrar tabla pedidos_camarero solo si el usuario es camarero -->
  <?php if ($rol_id == 3): ?>
    <div class="mt-5">
      <h4>📋 Pedidos Registrados</h4>
      <?php
        try {
            $db = new PDO('mysql:host=localhost;dbname=restaurante_db;charset=utf8', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->query("SELECT * FROM pedidos_camarero");
            $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error de conexión: " . $e->getMessage() . "</div>";
            $pedidos = [];
        }
      ?>

      <?php if (!empty($pedidos)): ?>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <?php foreach (array_keys($pedidos[0]) as $columna): ?>
                  <th><?= htmlspecialchars($columna) ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pedidos as $fila): ?>
                <tr>
                  <?php foreach ($fila as $valor): ?>
                    <td><?= htmlspecialchars($valor) ?></td>
                  <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-muted">No hay pedidos registrados.</p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
</body>
</html>

