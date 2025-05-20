<?php
// Incluir archivo de conexión para interactuar con la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verificar si la solicitud es POST (envío de formulario)
    $nombre = $_POST['nombre']; // Capturar el nombre del usuario
    $email = $_POST['email']; // Capturar el correo electrónico
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar la contraseña antes de guardarla

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

    // Ejecutar la consulta e imprimir mensaje de éxito o error
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>