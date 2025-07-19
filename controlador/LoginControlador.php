<?php
session_start();
require_once("../config/conexion.php");
require_once("../modelo/Usuario.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $usuario = Usuario::obtenerPorCorreoYClave($conexion, $correo, $clave);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../vista/dashboard.php");
    } else {
        echo "<script>alert('Credenciales inválidas');window.location='../vista/login.php';</script>";
    }
}
?>

?>