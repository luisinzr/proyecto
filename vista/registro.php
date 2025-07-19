<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="css/inicio-estilos.css" rel="stylesheet"> <!-- Enlace a tu nuevo CSS -->
</head>
<body class="registro-page">
  <div class="registro-container">
    <div class="col-md-6 mx-auto">
      <h3 class="mb-4 text-center">📝 Registro de Usuario</h3>
      <form action="../controlador/RegistroControlador.php" method="POST">

        <div class="mb-3">
          <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
          <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo electrónico</label>
          <input type="email" id="correo" name="correo" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="clave" class="form-label">Clave (0000 admin, 1111 chef, 2222 camarero, 3333 cliente)</label>
          <input type="password" id="clave" name="clave" class="form-control" required>
        </div>

        <div class="mb-3">
  <label for="rol" class="form-label">Rol</label>
  <select id="rol" name="rol" class="form-control" required>
    <option value="">-- Selecciona un rol --</option>
    <option value="1">Administrador</option>
    <option value="2">Chef</option>
    <option value="3">Camarero</option>
    <option value="4">Cliente</option>
  </select>
</div>
        <button type="submit" class="btn btn-primary w-100">Registrarse</button>

        <div class="text-center mt-3">
          <a href="../index.php" class="btn btn-link">← Volver al inicio</a>
        </div>

      </form>
    </div>
  </div>
</body>
</html>
