<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

$usuario_id = $_SESSION['usuario_id']; // Obtener ID del usuario actual

// Consultar pedidos realizados por el usuario
$sql = "SELECT id, fecha, total FROM pedidos WHERE usuario_id = $usuario_id ORDER BY fecha DESC";
$resultado = $conn->query($sql);
$pedidos = $resultado->fetch_all(MYSQLI_ASSOC);

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($pedidos);
?>