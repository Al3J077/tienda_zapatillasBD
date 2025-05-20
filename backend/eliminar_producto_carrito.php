<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si la solicitud es POST (eliminar producto)
    $usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario actual
    $producto_id = $_POST['producto_id']; // ID del producto a eliminar

    // Query para eliminar el producto del carrito del usuario
    $sql = "DELETE FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id";

    // Ejecutar la consulta e imprimir mensaje de éxito o error
    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado del carrito.";
    } else {
        echo "Error al eliminar producto: " . $conn->error;
    }
}
?>