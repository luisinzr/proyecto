<?php
class PedidoSeleccionado {
    public static function insertar($conexion, $usuario_id, $plato_id, $cantidad) {
        $stmt = $conexion->prepare("INSERT INTO pedidos_seleccionados (usuario_id, plato_id, cantidad) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $usuario_id, $plato_id, $cantidad);
        return $stmt->execute();
    }

    public static function obtenerPorUsuario($conexion, $usuario_id) {
        $sql = "SELECT ps.id, p.nombre_plato, ps.cantidad, ps.estado
                FROM pedidos_seleccionados ps
                JOIN platos p ON ps.plato_id = p.id
                WHERE ps.usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function obtenerTodos($conexion) {
    $sql = "SELECT ps.id, u.nombre_usuario, p.nombre_plato, ps.cantidad, ps.estado
            FROM pedidos_seleccionados ps
            JOIN usuarios u ON ps.usuario_id = u.id
            JOIN platos p ON ps.plato_id = p.id";
    $resultado = $conexion->query($sql);
    return $resultado;
}
public static function obtenerPedidosParaCamarero($conexion) {
    $sql = "SELECT ps.id, u.nombre_usuario, p.nombre_plato, ps.cantidad, ps.estado
            FROM pedidos_seleccionados ps
            JOIN usuarios u ON ps.usuario_id = u.id
            JOIN platos p ON ps.plato_id = p.id
            WHERE u.rol_id = 4"; // Solo clientes
    return $conexion->query($sql);
}

}
?>