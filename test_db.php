echo '<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$conexion = new mysqli("127.0.0.1", "root", "root", "restaurante_db");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
    }

    echo "Conexión exitosa a la base de datos";
    ?>' > test_db.php
