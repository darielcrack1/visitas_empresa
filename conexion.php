<?php
// conexion.php (más seguro y profesional)
$host = "localhost";
$user = "root";
$password = "";
$database = "empresa_visitas";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    die("Error en la conexión. Contacte al administrador.");
}
?>
