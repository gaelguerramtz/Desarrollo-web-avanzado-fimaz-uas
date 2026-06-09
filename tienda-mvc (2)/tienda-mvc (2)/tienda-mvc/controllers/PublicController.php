<?php
    namespace Controllers;

    use Models\ProductoModel;

    class PublicController {

        public function catalogo(): void {
            $termino = trim($_GET['buscar'] ?? '');
            $productoModel = new ProductoModel();
            $productos = $productoModel->buscarPublico($termino);
            require_once __DIR__ . '/../views/public/catalogo.php';
        }
    }
?>
