<?php
include 'conexion.php';
session_start();

$usuario_id = $_SESSION['usuario_id']; // Obtener usuario actual

// Obtener productos del carrito
$productos = obtenerCarrito($conn, $usuario_id);

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);
?>