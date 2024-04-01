<?php
session_start();

// Cierra la sesión y redirige al usuario a la página de inicio de sesión
session_destroy();
header("Location: login.php");
?>
