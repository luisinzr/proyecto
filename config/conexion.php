<?php
$host = "127.0.0.1";  // Cambiado de localhost a 127.0.0.1
$usuario = "root";
$password = "root";   // Cambia la contraseña aquí si la tienes diferente
$bd = "restaurante_db";

$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
