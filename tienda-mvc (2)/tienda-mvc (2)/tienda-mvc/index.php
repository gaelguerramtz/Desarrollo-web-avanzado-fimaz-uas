<?php

    require_once __DIR__ . '/config/Autoload.php';

    use Controllers\AuthController;
    use Controllers\ProductoController;
    use Controllers\PublicController;
    use Controllers\ApiController;

    $route = $_GET['route'] ?? 'catalogo';

    // Manejar preflight CORS para la API
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        http_response_code(204);
        exit;
    }

    $authController    = new AuthController();
    $productoController = new ProductoController();
    $publicController  = new PublicController();
    $apiController     = new ApiController();

    switch ($route) {

        // ── Autenticación ──────────────────────────────────────────────
        case 'login':
            $authController->showLogin();
            break;

        case 'auth/login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->login();
            }
            break;

        case 'logout':
            $authController->logout();
            break;

        // ── Administración de productos ────────────────────────────────
        case 'productos':
            $productoController->index();
            break;

        case 'productos/create':
            $productoController->create();
            break;

        case 'productos/store':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productoController->store();
            }
            break;

        case 'productos/edit':
            $productoController->edit();
            break;

        case 'productos/update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productoController->update();
            }
            break;

        case 'productos/delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productoController->delete();
            }
            break;

        // ── API REST ───────────────────────────────────────────────────
        case 'api/productos':
            $apiController->productos();
            break;

        case 'api/productos/show':
            $apiController->productoShow();
            break;

        case 'api/productos/buscar':
            $apiController->productosBuscar();
            break;

        // ── Catálogo público ───────────────────────────────────────────
        case 'catalogo':
        default:
            $publicController->catalogo();
            break;
    }
?>
