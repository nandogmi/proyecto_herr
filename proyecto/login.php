<!-- login.php -->
<?php
session_start();

// Verifica si el usuario está iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Si el usuario ya inició sesión, redirige a la página principal
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="logo_michi.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <style>
        body {
            background-color: #00CED1; /* Cambiado a verde turquesa */
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-fluid {
            max-width: 400px;
            margin-top: 50px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    
    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">
        <div class="d-flex justify-content-center">
            <div class = "logo">
                <img src="logo.png" alt="LOGO" />
            </div>
        </div>
        <div class="text-center fs-1 fw-bold"style="color: purple;">Login</div>

        <!-- Tu formulario de inicio de sesión existente -->
        <form action="login_handler.php" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" class="form-control" required>
            </div>

            <!-- Cambié la clase del botón a btn-success -->
            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
        </form>
        <!-- Fin del formulario existente -->
    </div>
</body>
</html>
