<?php
include 'conexion.php';

$filtro_marca = isset($_GET['marca']) ? $_GET['marca'] : ''; // Obtener marca
$filtro_precio_min = isset($_GET['min_precio']) ? $_GET['min_precio'] : 0; // Rango mínimo de precio
$filtro_precio_max = isset($_GET['max_precio']) ? $_GET['max_precio'] : 999999; // Rango máximo de precio

// Consulta con filtros
$sql = "SELECT * FROM productos WHERE precio BETWEEN $filtro_precio_min AND $filtro_precio_max";
if (!empty($filtro_marca)) {
    $sql .= " AND marca = '$filtro_marca'";
}

$resultado = $conn->query($sql);
$productos = $resultado->fetch_all(MYSQLI_ASSOC);

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);
?>