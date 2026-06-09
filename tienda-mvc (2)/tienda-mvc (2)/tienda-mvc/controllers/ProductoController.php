<?php
    namespace Controllers;

    use Models\ProductoModel;

    class ProductoController {
        private ProductoModel $productoModel;

        public function __construct()
        {
            $this->productoModel = new ProductoModel();
        }

        private function verificarSesion(): void {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['admin'])) {
                header('Location: index.php?route=login');
                exit;
            }
        }

        public function index(): void {
            $this->verificarSesion();
            $productos = $this->productoModel->obtenerTodos();
            require_once __DIR__ . '/../views/productos/index.php';
        }

        public function create(): void {
            $this->verificarSesion();
            require_once __DIR__ . '/../views/productos/create.php';
        }

        public function store(): void {
            $this->verificarSesion();

            $data = [
                'sku' => trim($_POST['sku'] ?? ''),
                'nombre' => trim($_POST['nombre'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'precio_compra' => trim($_POST['precio_compra'] ?? ''),
                'precio_venta' => trim($_POST['precio_venta'] ?? ''),
                'existencia' => trim($_POST['existencia'] ?? '')
            ];

            if (
                $data['sku'] === '' ||
                $data['nombre'] === '' ||
                $data['descripcion'] === '' ||
                $data['precio_compra'] === '' ||
                $data['precio_venta'] === '' ||
                $data['existencia'] === ''
            ) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: index.php?route=productos/create');
                exit;
            }

            if (!is_numeric($data['precio_compra']) || !is_numeric($data['precio_venta'])
                || !is_numeric($data['existencia'])) {
                $_SESSION['error'] = 'Precio de compra, precio de venta y existencia deben ser numericos.';
                header('Location: index.php?route=productos/create');
                exit;
            }

            if ((float)$data['precio_compra'] < 0 || (float)$data['precio_venta'] < 0
                || (int)$data['existencia'] < 0) {
                $_SESSION['error'] = 'No se permiten valores negativos.';
                header('Location: index.php?route=productos/create');
                exit;
            }

            if ($this->productoModel->crear($data)) {
                $_SESSION['success'] = 'Producto registrado correctamente.';
            } else {
                $_SESSION['error'] = 'No fue posible registrar el producto.';
            }

            header('Location: index.php?route=productos');
            exit;
        }

        public function edit(): void {
            $this->verificarSesion();

            $id = (int)($_GET['id'] ?? 0);
            $producto = $this->productoModel->obtenerPorId($id);

            if (!$producto) {
                $_SESSION['error'] = 'Producto no encontrado.';
                header('Location: index.php?route=productos');
                exit;
            }

            require_once __DIR__ . '/../views/productos/edit.php';
        }

        public function update(): void {
            $this->verificarSesion();

            $id = (int)($_POST['id'] ?? 0);

            $data = [
                'sku' => trim($_POST['sku'] ?? ''),
                'nombre' => trim($_POST['nombre'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'precio_compra' => trim($_POST['precio_compra'] ?? ''),
                'precio_venta' => trim($_POST['precio_venta'] ?? ''),
                'existencia' => trim($_POST['existencia'] ?? '')
            ];

            if ($id <= 0) {
                $_SESSION['error'] = 'ID invalido.';
                header('Location: index.php?route=productos');
                exit;
            }

            if (
                $data['sku'] === '' ||
                $data['nombre'] === '' ||
                $data['descripcion'] === '' ||
                $data['precio_compra'] === '' ||
                $data['precio_venta'] === '' ||
                $data['existencia'] === ''
            ) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: index.php?route=productos/edit&id=' . $id);
                exit;
            }

            if (!is_numeric($data['precio_compra']) || !is_numeric($data['precio_venta'])
                || !is_numeric($data['existencia'])) {
                $_SESSION['error'] = 'Precio de compra, precio de venta y existencia deben ser numericos.';
                header('Location: index.php?route=productos/edit&id=' . $id);
                exit;
            }

            if ((float)$data['precio_compra'] < 0 || (float)$data['precio_venta'] < 0 || (int)$data['existencia'] < 0) {
                $_SESSION['error'] = 'No se permiten valores negativos.';
                header('Location: index.php?route=productos/edit&id=' . $id);
                exit;
            }

            if ($this->productoModel->actualizar($id, $data)) {
                $_SESSION['success'] = 'Producto actualizado correctamente.';
            } else {
                $_SESSION['error'] = 'No fue posible actualizar el producto.';
            }

            header('Location: index.php?route=productos');
            exit;
        }

        public function delete(): void {
            $this->verificarSesion();

            $id = (int)($_POST['id'] ?? 0);

            if ($id <= 0) {
                $_SESSION['error'] = 'ID invalido.';
                header('Location: index.php?route=productos');
                exit;
            }

            if ($this->productoModel->eliminar($id)) {
                $_SESSION['success'] = 'Producto eliminado correctamente.';
            } else {
                $_SESSION['error'] = 'No fue posible eliminar el producto.';
            }

            header('Location: index.php?route=productos');
            exit;
        }
    }
?>
