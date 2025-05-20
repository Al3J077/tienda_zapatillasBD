<?php
session_start(); // Iniciar sesión para poder destruirla
session_destroy(); // Destruir todos los datos de sesión
header("Location: ../frontend/html/index.html"); // Redirigir al usuario al inicio
exit(); // Finalizar el script
?>