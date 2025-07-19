<?php
class Plato {
    public static function obtenerTodos($conexion) {
        return $conexion->query("SELECT * FROM platos");
    }
}
?>