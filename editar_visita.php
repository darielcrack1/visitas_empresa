<?php
require_once 'conexion.php';

// Verificar si se recibe el ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: visitas.php");
    exit;
}

$id = intval($_GET['id']);

// Obtener datos de la visita
$stmt = $conn->prepare("SELECT * FROM visitas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$visita = $resultado->fetch_assoc();
$stmt->close();

if (!$visita) {
    header("Location: visitas.php");
    exit;
}

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telefono = trim($_POST['telefono']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $empresa = trim($_POST['empresa']);
    $motivo = trim($_POST['motivo']);

    if ($telefono === '' || $nombre === '' || $apellido === '' || $correo === '' || $empresa === '' || $motivo === '') {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Actualizar visita
        $stmt = $conn->prepare("UPDATE visitas SET telefono=?, nombre=?, apellido=?, correo=?, empresa=?, motivo=? WHERE id=?");
        $stmt->bind_param("ssssssi", $telefono, $nombre, $apellido, $correo, $empresa, $motivo, $id);
        if ($stmt->execute()) {
            header("Location: visitas.php");
            exit;
        } else {
            $error = "Error al actualizar la visita.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Visita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="text-center p-4 mb-4 bg-white border rounded shadow-sm">
        <h1 class="display-5 fw-bold text-warning">✏️ Editar Visita</h1>
        <p class="text-muted">Modifique los datos de la visita seleccionada</p>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($visita['telefono']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($visita['nombre']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="apellido" value="<?= htmlspecialchars($visita['apellido']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" value="<?= htmlspecialchars($visita['correo']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Empresa</label>
            <input type="text" name="empresa" value="<?= htmlspecialchars($visita['empresa']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Motivo</label>
            <input type="text" name="motivo" value="<?= htmlspecialchars($visita['motivo']) ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
        <a href="visitas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>
