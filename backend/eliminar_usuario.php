<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para obtener el usuario actual

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $usuario_id = $_SESSION['usuario_id']; // ID del usuario actual

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = $usuario_id";

    if ($conn->query($sql) === TRUE) {
        session_destroy(); // Cerrar sesión después de eliminar la cuenta
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar usuario: " . $conn->error;
    }
}
?>