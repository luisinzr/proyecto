<?php
class Usuario {
    public static function obtenerPorCorreoYClave($conexion, $correo, $clave) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ? AND clave = ?");
        $stmt->bind_param("ss", $correo, $clave);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public static function obtenerClientes($conexion) {
    $sql = "SELECT id, nombre_usuario FROM usuarios WHERE rol_id = 4";
    return $conexion->query($sql);
}

    public static function obtenerTodos($conexion) {
        $sql = "SELECT usuarios.*, roles.nombre AS rol_nombre FROM usuarios 
                JOIN roles ON usuarios.rol_id = roles.id";
        return $conexion->query($sql);
    }

}
?>
