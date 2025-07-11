<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function limpiar($valor) {
        return trim(htmlspecialchars($valor));
    }

    $telefono = limpiar($_POST['telefono']);
    $nombre = limpiar($_POST['nombre']);
    $apellido = limpiar($_POST['apellido']);
    $correo = limpiar($_POST['correo']);
    $empresa = limpiar($_POST['empresa']);
    $motivo = limpiar($_POST['motivo']);

    // Validaciones
    if ($telefono === '' || $nombre === '' || $apellido === '' || $correo === '' || $empresa === '' || $motivo === '') {
        header("Location: index.php?error=campos_vacios"); exit;
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=correo_invalido"); exit;
    }
    if (!preg_match('/^[0-9+\-() ]{7,20}$/', $telefono)) {
        header("Location: index.php?error=telefono_invalido"); exit;
    }

    $stmt = $conn->prepare("INSERT INTO visitas (telefono, nombre, apellido, correo, empresa, motivo) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssss", $telefono, $nombre, $apellido, $correo, $empresa, $motivo);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php?success=1");
    } else {
        header("Location: index.php?error=db");
    }
} else {
    header("Location: index.php");
}
?>
