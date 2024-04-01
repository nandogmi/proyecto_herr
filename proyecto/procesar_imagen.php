<?php
session_start();

// Verificar si el usuario es un administrador
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Directorio donde se guardarán las imágenes cargadas
$ruta_destino = 'imagenes/';

// Obtener información del archivo
$nombre_archivo = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];

// Mover el archivo a la carpeta de destino
$ruta_final = $ruta_destino . $nombre_archivo;
move_uploaded_file($ruta_temporal, $ruta_final);

// Insertar la información en la base de datos (estado inicial: en revisión)
$servername = "localhost";
$dbname = "bd_michinieros";
$username = "root";
$password = "3803";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$nombre_imagen = mysqli_real_escape_string($conn, $nombre_archivo);

$sql_insert = "INSERT INTO imagenes (nombre, ruta, estado) VALUES ('$nombre_imagen', '$ruta_final', 'en_revision')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Imagen cargada exitosamente.";
} else {
    echo "Error al cargar la imagen: " . $conn->error;
}

$conn->close();
?>
