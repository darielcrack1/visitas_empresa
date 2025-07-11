<?php
session_start();
require_once 'conexion.php';

// Generar token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Visitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body.dark-mode {
        background-color: #121212 !important;
        color: #ffffff !important;
    }

    .dark-mode .card,
    .dark-mode .table,
    .dark-mode .bg-white,
    .dark-mode .form-control {
        background-color: #1e1e1e !important;
        color: #ffffff !important;
        border-color: #444;
    }

    .mode-toggle {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .form-label {
        font-weight: bold;
    }
    </style>
</head>
<body class="bg-light" id="main-body">

<!-- Botón de modo oscuro -->
<button class="btn btn-outline-secondary mode-toggle" onclick="toggleMode()">🌙 / ☀️</button>

<main class="container mt-5">

    <!-- Encabezado -->
    <div class="text-center p-4 mb-4 bg-white border rounded shadow-sm">
        <h1 class="display-5 fw-bold text-primary">📋 Registro de Visitas</h1>
        <p class="lead">Complete el formulario para registrar una nueva visita</p>
    </div>

    <!-- Alertas -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">✅ Visita registrada correctamente.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php
            switch ($_GET['error']) {
                case '1': echo "❌ Todos los campos son obligatorios."; break;
                case '2': echo "❌ Error al registrar la visita."; break;
                default: echo "❌ Error desconocido.";
            }
            ?>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <form action="guardar_visita.php" method="post" class="card p-4 shadow-sm needs-validation" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="mb-3">
            <label for="telefono" class="form-label">📞 Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">👤 Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">👤 Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">📧 Correo Electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="empresa" class="form-label">🏢 Empresa</label>
            <input type="text" name="empresa" id="empresa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="motivo" class="form-label">📝 Motivo de la Visita</label>
            <input type="text" name="motivo" id="motivo" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Guardar Visita</button>
            <a href="visitas.php" class="btn btn-secondary">Ver Visitas</a>
        </div>
    </form>

</main>

<!-- Script de modo oscuro y validación -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem("modo") === "oscuro") {
            document.body.classList.add("dark-mode");
        }

        // Validación Bootstrap
        let forms = document.querySelectorAll(".needs-validation");
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener("submit", function (e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add("was-validated");
            }, false);
        });
    });

    function toggleMode() {
        document.body.classList.toggle("dark-mode");
        localStorage.setItem("modo", document.body.classList.contains("dark-mode") ? "oscuro" : "claro");
    }
</script>

</body>
</html>
