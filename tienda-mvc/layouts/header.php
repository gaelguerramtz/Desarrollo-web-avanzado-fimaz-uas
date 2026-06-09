<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Desarrollo Web Avanzado: PoO+PDO+TryCatch-Namespaces-Autoload-Transacciones-MVC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
              crossorigin="anonymous">
        <style>
            body { min-height: 100vh; display: flex; flex-direction: column; }
            main, .container.mt-4 { flex: 1; }
        </style>
    </head>
    <body>

        <!-- Navbar responsiva con toggler para móvil -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php?route=catalogo">
                    Tienda MVC
                </a>

                <!-- Botón hamburguesa para pantallas pequeñas -->
                <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarPrincipal"
                        aria-controls="navbarPrincipal"
                        aria-expanded="false"
                        aria-label="Abrir menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menú colapsable -->
                <div class="collapse navbar-collapse" id="navbarPrincipal">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <div class="d-flex gap-2">
                        <?php if (isset($_SESSION['admin'])): ?>
                            <span class="navbar-text me-2 text-light small">
                                <?= htmlspecialchars($_SESSION['admin']['nombre_completo']); ?>
                            </span>
                            <a class="btn btn-outline-light btn-sm" href="index.php?route=productos">Panel</a>
                            <a class="btn btn-danger btn-sm" href="index.php?route=logout">Salir</a>
                        <?php else: ?>
                            <a class="btn btn-warning btn-sm" href="index.php?route=login">Administrador</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>
