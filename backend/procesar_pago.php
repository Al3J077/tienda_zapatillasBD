<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id']; // Obtener el usuario actual
    $metodo_pago = $_POST['metodo_pago']; // Obtener el método de pago seleccionado

    // Simular pago exitoso
    $sql = "INSERT INTO pagos (usuario_id, metodo_pago, estado) VALUES ($usuario_id, '$metodo_pago', 'Aprobado')";

    if ($conn->query($sql) === TRUE) {
        echo "Pago realizado con éxito con " . $metodo_pago;
    } else {
        echo "Error al procesar el pago: " . $conn->error;
    }
}
?>