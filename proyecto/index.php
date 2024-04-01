<?php
session_start();

// Verifica si el usuario está iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en la sesión, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

?>
