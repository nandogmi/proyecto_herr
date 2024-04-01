<?php
session_start();

// Verifica si el usuario está iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en la sesión, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];

$ruta_imagenes = 'imagenes/';

$imagenes = glob($ruta_imagenes . '*.{jpg,jpeg,png}', GLOB_BRACE);

// Obtener la dirección IP del usuario
$ip = $_SERVER['REMOTE_ADDR'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="logo_michi.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="usuario_.css">
</head>

<body>
    <!-- Barra superior desplegable (navbar) -->
    <!-- ... (código del navbar) ... -->
    <!-- Barra superior desplegable (navbar) -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class = "logo">
            <img src="logo.png" alt="LOGO" />
        </div>
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#cerrarSesion" aria-expanded="false" aria-controls="cerrarSesion">
                            Bienvenido <i class="bi bi-caret-down"></i>
                        </button>
                        <div class="collapse" id="cerrarSesion">
                            <div class="card card-body">
                            <a href="logout.php" class="dropdown-item">Cerrar sesión</a>
                            <!-- Otros elementos del menú desplegable si los necesitas -->
                        </div>
                    </div>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div id="carouselExample" class="carousel slide mt-3" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($imagenes as $index => $imagen): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo $imagen; ?>" class="d-block w-100"
                            alt="Imagen <?php echo $index + 1; ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

<footer>
</footer>

</html>
