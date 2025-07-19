<?php
session_start();
require_once("../config/conexion.php");
require_once("../modelo/Usuario.php");

// Mostrar errores en pantalla para depuración en Codespace
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $usuario = Usuario::obtenerPorCorreoYClave($conexion, $correo, $clave);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header("Location: /vista/dashboard.php"); // Ruta corregida
        exit(); // Muy importante para evitar que se ejecute más código
    } else {
        echo "<script>alert('Credenciales inválidas');window.location='../vista/login.php';</script>";
    }
}
