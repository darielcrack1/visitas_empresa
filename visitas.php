<?php require_once 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Visitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
    background-color: #121212 !important;
    color: #ffffff !important;
}

/* Estilos oscuros aplicados a elementos específicos */
.dark-mode .card,
.dark-mode .table,
.dark-mode .form-control,
.dark-mode .bg-white,
.dark-mode .table-responsive,
.dark-mode .border,
.dark-mode .thead-dark,
.dark-mode .table th,
.dark-mode .table td {
    background-color: #1e1e1e !important;
    color: #ffffff !important;
    border-color: #444 !important;
}

/* Estilo del encabezado */
.dark-mode .encabezado {
    background-color: #1e1e1e !important;
    color: white !important;
    border: 1px solid #444 !important;
}

/* Botones */
.dark-mode .btn-success {
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}

.dark-mode .btn-warning {
    background-color: #ffc107 !important;
    border-color: #ffc107 !important;
    color: black !important;
}

.dark-mode .btn-danger {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
/* Estilo para la descripción */
.descripcion {
    color: #6c757d; /* gris por defecto en claro */
}

.dark-mode .descripcion {
    color: #cccccc !important; /* más clara para fondo oscuro */
}

    </style>
</head>
<body class="bg-light" id="main-body">

<!-- Botón de cambio de modo -->
<button class="btn btn-outline-secondary mode-toggle" onclick="toggleMode()">🌙 / ☀️</button>

<div class="container mt-5">

    <!-- Encabezado -->
    <div class="text-center p-4 mb-4 encabezado rounded shadow-sm">
        <h1 class="display-5 fw-bold text-success">📑 Lista de Visitas</h1>
        <p class="descripcion">Consulta todas las visitas registradas en el sistema</p>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="index.php" class="btn btn-success">+ Registrar nueva visita</a>
    </div>

    <?php
    $resultado = $conn->query("SELECT * FROM visitas ORDER BY fecha_registro DESC");
    if ($resultado && $resultado->num_rows > 0):
    ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle bg-white shadow-sm">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Teléfono</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Empresa</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['id']) ?></td>
                        <td><?= htmlspecialchars($fila['telefono']) ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['apellido']) ?></td>
                        <td><?= htmlspecialchars($fila['correo']) ?></td>
                        <td><?= htmlspecialchars($fila['empresa']) ?></td>
                        <td><?= htmlspecialchars($fila['motivo']) ?></td>
                        <td><?= htmlspecialchars($fila['fecha_registro']) ?></td>
                        <td>
                            <a href="editar_visita.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminar_visita.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No hay visitas registradas aún.</div>
    <?php endif; ?>
</div>

<!-- Script para cambiar entre modo claro y oscuro -->
<script>
    // Aplicar modo guardado
    document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem("modo") === "oscuro") {
            document.body.classList.add("dark-mode");
        }
    });

    function toggleMode() {
        document.body.classList.toggle("dark-mode");
        const modoActual = document.body.classList.contains("dark-mode") ? "oscuro" : "claro";
        localStorage.setItem("modo", modoActual);
    }
</script>

</body>
</html>
