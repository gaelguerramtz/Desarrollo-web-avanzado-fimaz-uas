<?php
    namespace Controllers;

    use Models\ProductoModel;

    /**
     * ApiController — Controlador de la API REST.
     *
     * Expone endpoints que devuelven datos en formato JSON.
     * No requiere sesión iniciada (API pública de lectura).
     */
    class ApiController {

        private ProductoModel $productoModel;

        public function __construct()
        {
            $this->productoModel = new ProductoModel();
        }

        /**
         * Envía las cabeceras JSON y CORS apropiadas.
         */
        private function jsonHeaders(): void
        {
            header('Content-Type: application/json; charset=utf-8');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization');
        }

        /**
         * Responde con un JSON estándar.
         *
         * @param mixed $data    Datos a serializar.
         * @param int   $status  Código HTTP de respuesta.
         */
        private function responder(mixed $data, int $status = 200): void
        {
            $this->jsonHeaders();
            http_response_code($status);
            echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        // ----------------------------------------------------------------
        // GET  index.php?route=api/productos
        // Devuelve todos los productos en formato JSON.
        // ----------------------------------------------------------------
        public function productos(): void
        {
            $productos = $this->productoModel->obtenerTodos();

            $this->responder([
                'status'  => 'success',
                'total'   => count($productos),
                'data'    => $productos,
            ]);
        }

        // ----------------------------------------------------------------
        // GET  index.php?route=api/productos/show&id=N
        // Devuelve un producto por ID.
        // ----------------------------------------------------------------
        public function productoShow(): void
        {
            $id = (int)($_GET['id'] ?? 0);

            if ($id <= 0) {
                $this->responder(['status' => 'error', 'mensaje' => 'ID inválido.'], 400);
            }

            $producto = $this->productoModel->obtenerPorId($id);

            if (!$producto) {
                $this->responder(['status' => 'error', 'mensaje' => 'Producto no encontrado.'], 404);
            }

            $this->responder(['status' => 'success', 'data' => $producto]);
        }

        // ----------------------------------------------------------------
        // GET  index.php?route=api/productos/buscar&q=termino
        // Busca productos por nombre o descripción.
        // ----------------------------------------------------------------
        public function productosBuscar(): void
        {
            $termino  = trim($_GET['q'] ?? '');
            $productos = $this->productoModel->buscarPublico($termino);

            $this->responder([
                'status'  => 'success',
                'termino' => $termino,
                'total'   => count($productos),
                'data'    => $productos,
            ]);
        }
    }
?>
