<?php
require_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ejecutar eliminación
    $sql = "DELETE FROM visitas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: visitas.php?mensaje=eliminado"); // o el nombre correcto de tu index
        exit();
    } else {
        echo "Error al eliminar la visita: " . $conn->error;
    }
} else {
    echo "ID no válido.";
}
?>
