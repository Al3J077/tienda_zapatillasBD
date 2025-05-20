<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si la solicitud es POST (cancelar pedido)
    $pedido_id = $_POST['pedido_id']; // ID del pedido a cancelar
    $usuario_id = $_SESSION['usuario_id']; // Obtener usuario actual

    // Verificar si el pedido pertenece al usuario
    $sql_verificar = "SELECT * FROM pedidos WHERE id = $pedido_id AND usuario_id = $usuario_id";
    $resultado = $conn->query($sql_verificar);

    if ($resultado->num_rows > 0) {
        // Eliminar el pedido de la base de datos
        $sql_cancelar = "DELETE FROM pedidos WHERE id = $pedido_id";
        if ($conn->query($sql_cancelar) === TRUE) {
            echo "Pedido cancelado correctamente.";
        } else {
            echo "Error al cancelar pedido: " . $conn->error;
        }
    } else {
        echo "Pedido no encontrado o no pertenece al usuario.";
    }
}
?>