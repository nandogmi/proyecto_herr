<?php
session_start();

// Se definen credenciales de usuarios
$usuarios = [
    'usuario' => '1234',
    'admin' => 'LabHerr2023',
    'superadmin' => 'ArgosLab2023'
];

// Recibe las credenciales del formulario
$usuarioIngresado = $_POST['usuario'];
$contrasenaIngresada = $_POST['contrasena'];

// Verifica las credenciales
if (array_key_exists($usuarioIngresado, $usuarios) && $usuarios[$usuarioIngresado] === $contrasenaIngresada) {
    // Inicia sesión y redirige al usuario a la página principal
    $_SESSION['usuario'] = $usuarioIngresado;
    switch ($usuarioIngresado) {
        case 'usuario':
            header("Location: pagina_usuario.php");
            exit();
        case 'admin':
            header("Location: pagina_admin.php");
            exit();
        case 'superadmin':
            header("Location: pagina_superadmin.php");
            exit();
        default:
            // Manejar cualquier otro caso si es necesario
            break;
    }

    // Agrega información adicional sobre el tipo de usuario si es necesario
    // $_SESSION['tipo_usuario'] = 'comun'; // Puedes ajustar según tus necesidades

    header("Location: index.php");
} else {
    // Si las credenciales no son válidas, muestra un mensaje de error
    $_SESSION['error'] = "Usuario o contraseña incorrectos.";
    header("Location: login.php");
}
?>
