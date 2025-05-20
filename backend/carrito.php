<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si la solicitud es POST (agregar producto)
    $usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario actual
    $producto_id = $_POST['producto_id']; // ID del producto a agregar
    $cantidad = $_POST['cantidad']; // Cantidad del producto

    // Verificar si el producto ya está en el carrito del usuario
    $sql = "SELECT * FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // Si el producto ya está en el carrito, actualizar cantidad
        $sql = "UPDATE carrito SET cantidad = cantidad + $cantidad WHERE usuario_id = $usuario_id AND producto_id = $producto_id";
    } else {
        // Si el producto no está, agregarlo al carrito
        $sql = "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($usuario_id, $producto_id, $cantidad)";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado al carrito.";
    } else {
        echo "Error al agregar producto: " . $conn->error;
    }
}

// Mostrar productos en el carrito del usuario
function obtenerCarrito($conn, $usuario_id) {
    $sql = "SELECT p.nombre, p.precio, c.cantidad 
            FROM carrito c
            JOIN productos p ON c.producto_id = p.id
            WHERE c.usuario_id = $usuario_id";
    $resultado = $conn->query($sql);
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
?>