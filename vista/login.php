<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../css/inicio-estilos.css">
</head>
<body class="login-page"> <!-- 👈 AÑADE ESTA CLASE -->
  <div class="login-container">
    <!-- contenido del formulario de login -->
  </div>
</body>
</html>
<body>
  <div class="container mt-5">
    <div class="col-md-6 mx-auto">
      <h3 class="mb-3">Iniciar Sesión</h3>
      <form action="../controlador/LoginControlador.php" method="POST">
        <input type="email" name="correo" class="form-control mb-2" placeholder="Correo" required>
        <input type="password" name="clave" class="form-control mb-2" placeholder="Clave (0000, 1111...)" required>
        <button class="btn btn-success w-100">Ingresar</button>
      </form>
    </div>
  </div>
</body>
</html>
