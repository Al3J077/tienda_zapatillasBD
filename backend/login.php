<?php
// Incluir conexión con la base de datos
include 'conexion.php';
session_start(); // Iniciar sesión para almacenar datos del usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verificar si la solicitud es POST
    $email = $_POST['email']; // Capturar el email ingresado
    $contraseña = $_POST['contraseña']; // Capturar la contraseña ingresada

    // Consultar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) { // Si el usuario existe
        $usuario = $resultado->fetch_assoc(); // Obtener sus datos

        // Verificar si la contraseña ingresada coincide con la almacenada
        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id']; // Guardar ID en sesión
            $_SESSION['nombre'] = $usuario['nombre']; // Guardar nombre en sesión
            echo "Inicio de sesión exitoso."; // Mensaje de éxito
        } else {
            echo "Contraseña incorrecta."; // Mensaje de error
        }
    } else {
        echo "Usuario no encontrado."; // Mensaje si el usuario no está registrado
    }
}
?>