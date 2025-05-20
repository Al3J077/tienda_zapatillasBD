<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

$usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario que realiza la compra

// Obtener productos en el carrito del usuario
$sql_carrito = "SELECT producto_id, cantidad FROM carrito WHERE usuario_id = $usuario_id";
$resultado_carrito = $conn->query($sql_carrito);

if ($resultado_carrito->num_rows > 0) {
    $total = 0;
    
    // Recorrer los productos en el carrito y calcular total
    while ($producto = $resultado_carrito->fetch_assoc()) {
        $producto_id = $producto['producto_id'];
        $cantidad = $producto['cantidad'];

        // Obtener precio del producto
        $sql_precio = "SELECT precio FROM productos WHERE id = $producto_id";
        $resultado_precio = $conn->query($sql_precio);
        $datos_precio = $resultado_precio->fetch_assoc();
        $precio = $datos_precio['precio'];

        $total += $precio * $cantidad;
    }

    // Insertar el pedido en la tabla pedidos
    $sql_pedido = "INSERT INTO pedidos (usuario_id, total) VALUES ($usuario_id, $total)";
    if ($conn->query($sql_pedido) === TRUE) {
        // Vaciar el carrito después de realizar la compra
        $sql_vaciar_carrito = "DELETE FROM carrito WHERE usuario_id = $usuario_id";
        $conn->query($sql_vaciar_carrito);
        
        echo "Pedido realizado con éxito. Total: $" . $total;
    } else {
        echo "Error al procesar el pedido: " . $conn->error;
    }
} else {
    echo "No hay productos en el carrito.";
}
?>