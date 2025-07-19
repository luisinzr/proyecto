<?php
require_once("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"]; // Contraseña del usuario
$rol_id = $_POST["rol"];  // ID del rol desde el <select>

if (!in_array($rol_id, ["1", "2", "3", "4"])) {
    echo "<script>alert('⚠️ Debes seleccionar un rol válido.'); window.location='../vista/registro.php';</script>";
    exit();
}

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo, clave, rol_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nombre_usuario, $correo, $clave, $rol_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Registro exitoso. Ahora puedes iniciar sesión.'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('❌ Error al registrar. Puede que el correo ya exista.'); window.location='../vista/registro.php';</script>";
    }
}
?>

