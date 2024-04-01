<?php
session_start();

// Verifica si el usuario está iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en la sesión, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];
$imagenes = [];

$ruta_imagenes = 'pendientes/';
$ruta_rechazados = 'rechazar/';
$ruta_aprobados = 'imagenes/';

$imagenes_rechazar = glob($ruta_rechazados . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

$imagenes = glob($ruta_imagenes . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

$imagenes_aprobados = glob($ruta_aprobados . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Obtener la dirección IP del usuario
$ip = $_SERVER['REMOTE_ADDR'];
?>
<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['aprobar'])) {
                // Lógica para aprobar la imagen
                $imagenAprobar = urldecode($_POST['aprobar']);
                $rutaImagenPendiente = 'pendientes/' . basename($imagenAprobar);
                $rutaImagenAprobada = 'imagenes/' . basename($imagenAprobar);
                $rutaImagenRechazar = 'rechazar/' . basename($imagenAprobar);

                // Verificar si el archivo existe antes de intentar moverlo
                if (file_exists($rutaImagenPendiente)) {
                    // Mueve la imagen de la carpeta "pendientes/" a la carpeta "imagenes/"
                    if (rename($rutaImagenPendiente, $rutaImagenAprobada)) {
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit();
                    } else {
                        echo 'Error al mover la imagen.';
                    }
                }
                elseif (file_exists($rutaImagenRechazar)) {
                    // Mueve la imagen de la carpeta "pendientes/" a la carpeta "imagenes/"
                    if (rename($rutaImagenRechazar, $rutaImagenAprobada)) {
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit();
                    } else {
                        echo 'Error al mover la imagen.';
                    }
                }
                 else {
                    echo 'Error: El archivo no existe.';
                }
            } elseif (isset($_POST['rechazar'])) {
                // Lógica para rechazar la imagen
                $imagenRechazar = urldecode($_POST['rechazar']);
                $rutaImagenPendiente = 'pendientes/' . basename($imagenRechazar);
                $rutaImagenAprobada = 'imagenes/' . basename($imagenRechazar);
                $rutaImagenRechazar = 'rechazar/' . basename($imagenRechazar);
                $rutaImagenPapelera = 'papelera/' . basename($imagenRechazar);

                // Verificar si el archivo existe antes de intentar moverlo
                if (file_exists($rutaImagenPendiente)) {
                    // Mueve la imagen de la carpeta "pendientes/" a la carpeta "rechazar/"
                    if (rename($rutaImagenPendiente, $rutaImagenRechazar)) {
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit();
                    } else {
                        echo 'Error al mover la imagen.';
                    }
                }
                elseif (file_exists($rutaImagenRechazar)) {
                    // Mueve la imagen de la carpeta "pendientes/" a la carpeta "rechazar/"
                    if (rename($rutaImagenRechazar, $rutaImagenPapelera)) {
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit();
                    } else {
                        echo 'Error al mover la imagen.';
                    }
                }elseif (file_exists($rutaImagenAprobada)) {
                    // Mueve la imagen de la carpeta "pendientes/" a la carpeta "rechazar/"
                    if (rename($rutaImagenAprobada, $rutaImagenRechazar)) {
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit();
                    } else {
                        echo 'Error al mover la imagen.';
                    }
                }
                 else {
                    echo 'Error: El archivo no existe.';
                }
            }
        }
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="logo_michi.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="superadmin_style.css">
    <title>Administración</title>
</head>

<body>


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


    <h1 class="titulo">Archivos</h1>

    <div class="container">
        <div class="miniatures mt-3 text-start mx-auto">
            <div class="row">
                <!-- Pendientes a la izquierda -->
                <div class="col-md-4 miniatures-column">
                    
                    <h1 class="titulo">Pendientes</h1>
                    <h2 class = "contenedor_h2">
                        <div class="miniatures mt-3 text-start mx-auto">
                            <?php foreach ($imagenes as $index => $imagen): ?>
                                <div class="mb-3 d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="<?php echo $imagen; ?>" class="carousel-thumbnail"
                                            data-imagen="<?php echo urlencode($imagen); ?>"
                                            alt="Imagen <?php echo $index; ?>"
                                            onclick="abrirModal('<?php echo $imagen; ?>')">
                                    </div>
                                    <div class="btn-group" role="group">
                                        <form id="form-<?php echo $index; ?>" method="post" action="">
                                            <input type="hidden" name="aprobar" value="<?php echo urlencode($imagen); ?>">
                                            <button type="submit" class="btn btn-success aprobar-btn">Aprobar</button>
                                        </form>
                                        <form id="form-rechazar-<?php echo $index; ?>" method="post" action="">
                                            <input type="hidden" name="rechazar" value="<?php echo urlencode($imagen); ?>">
                                            <button type="submit" class="btn btn-danger rechazar-btn">Rechazar</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </h2>
                </div>
                <div class="col-md-4 miniatures-column">
                    <h1 class="titulo">Aprobados</h1>
                    <h2 class = "contenedor_h2">
                        <div class="miniatures mt-3 text-start mx-auto">
                            <?php foreach ($imagenes_aprobados as $index => $imagen): ?>
                                <div class="mb-3 d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="<?php echo $imagen; ?>" class="carousel-thumbnail"
                                            data-imagen="<?php echo urlencode($imagen); ?>"
                                            alt="Imagen <?php echo $index; ?>"
                                            onclick="abrirModal('<?php echo $imagen; ?>')">
                                    </div>
                                    <div class="btn-group" role="group">
                                        <form id="form-rechazar-<?php echo $index; ?>" method="post" action="">
                                            <input type="hidden" name="rechazar" value="<?php echo urlencode($imagen); ?>">
                                            <button type="submit" class="btn btn-danger rechazar-btn">Rechazar</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </h2>
                </div>
                <div class="col-md-4 miniatures-column">
                    <h1 class="titulo">Rechazados</h1>
                    <h2 class = "contenedor_h2">
                        <div class="miniatures mt-3 text-start mx-auto">
                            <?php foreach ($imagenes_rechazar as $index => $imagen): ?>
                                <div class="mb-3 d-flex align-items-center">
                                <div class="me-3">
                                    <img src="<?php echo $imagen; ?>" class="carousel-thumbnail"
                                        data-imagen="<?php echo urlencode($imagen); ?>"
                                        alt="Imagen <?php echo $index; ?>"
                                        onclick="abrirModal('<?php echo $imagen; ?>')">
                                </div>
                                    <div class="btn-group" role="group">
                                        <form id="form-<?php echo $index; ?>" method="post" action="">
                                            <input type="hidden" name="aprobar" value="<?php echo urlencode($imagen); ?>">
                                            <button type="submit" class="btn btn-success aprobar-btn">Aprobar</button>
                                        </form>
                                        <form id="form-rechazar-<?php echo $index; ?>" method="post" action="">
                                            <input type="hidden" name="rechazar" value="<?php echo urlencode($imagen); ?>">
                                            <button type="submit" class="btn btn-danger rechazar-btn">Enviar a papelera</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>                        
                        </div>
                    </h2>
                        
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Modal para previsualización de imagen -->
    <div class="modal fade" id="imagenModal" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="imagenModalLabel">Previsualización de Imagen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img id="imagenPrevia" src="" alt="Previsualización de Imagen" style="max-width: 100%; height: auto;">
        </div>
        </div>
    </div>
    </div>

<script>
  // Función para abrir el modal con la imagen
  function abrirModal(imagenSrc) {
    document.getElementById('imagenPrevia').src = imagenSrc;
    var myModal = new bootstrap.Modal(document.getElementById('imagenModal'));
    myModal.show();
  }
</script>

</body>

<footer>
</footer>

</html>
        