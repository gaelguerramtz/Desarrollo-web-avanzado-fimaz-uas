<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/../CONFIG/database.php";
require_once __DIR__ . "/../CLASES/productos.php";

$instancia_bd = new Database();
$conexion_activa = $instancia_bd->getConnection();
$gestor_producto = new Productos($conexion_activa);

$metodo_http = $_SERVER['REQUEST_METHOD'];
$uri_limpia = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$directorio_raiz = dirname($_SERVER['SCRIPT_NAME']);
$ruta_relativa = str_replace($directorio_raiz, '', $uri_limpia);
$ruta_partes = explode('/', trim($ruta_relativa, '/'));

if (empty($ruta_partes[0]) || $ruta_partes[0] !== 'productos') {
    http_response_code(404);
    echo json_encode(["message" => "Recurso no encontrado"]);
    exit;
}

$id_recurso = (isset($ruta_partes[1]) && is_numeric($ruta_partes[1])) ? (int)$ruta_partes[1] : null;
$total_segmentos = count($ruta_partes);

switch ($metodo_http) {
    
    case 'GET':
        if ($total_segmentos === 1) {
            $dataset = $gestor_producto->getProductos();
            
            if ($dataset->rowCount() > 0) {
                $lista_productos = $dataset->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                echo json_encode($lista_productos);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "No se encontraron productos"]);
            }
        } 
        elseif ($total_segmentos === 2 && $id_recurso) {
            $gestor_producto->idProducto = $id_recurso;
            
            if ($gestor_producto->getProducto()) {
                http_response_code(200);
                echo json_encode([
                    "idProducto" => $gestor_producto->idProducto,
                    "nombreproducto" => $gestor_producto->nombreproducto,
                    "descripcion" => $gestor_producto->descripcion,
                    "precioCompra" => $gestor_producto->precioCompra,
                    "precioVenta" => $gestor_producto->precioVenta,
                    "existencia" => $gestor_producto->existencia
                ]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Producto no encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Parámetros de ruta incorrectos"]);
        }
        break;

    case 'POST':
        if ($total_segmentos !== 1) {
            http_response_code(400);
            echo json_encode(["message" => "Ruta de creación incorrecta"]);
            exit;
        }

        $payload = json_decode(file_get_contents("php://input"));
        $fallos_validacion = [];

        if (empty($payload->nombreproducto)) {
            $fallos_validacion[] = "El nombre del producto es obligatorio";
        }
        if (!isset($payload->precioCompra) || $payload->precioCompra < 0) {
            $fallos_validacion[] = "El precio de compra no puede ser negativo";
        }
        if (!isset($payload->precioVenta) || $payload->precioVenta < 0) {
            $fallos_validacion[] = "El precio de venta no puede ser negativo";
        }
        if (!isset($payload->existencia) || $payload->existencia < 0) {
            $fallos_validacion[] = "La existencia no puede ser negativa";
        }
        if (isset($payload->precioVenta, $payload->precioCompra) && $payload->precioVenta < $payload->precioCompra) {
            $fallos_validacion[] = "El precio de venta no puede ser menor al de compra";
        }

        if (!empty($fallos_validacion)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "errores" => $fallos_validacion]);
            exit;
        }

        $gestor_producto->nombreproducto = $payload->nombreproducto;
        $gestor_producto->descripcion = $payload->descripcion;
        $gestor_producto->precioCompra = $payload->precioCompra;
        $gestor_producto->precioVenta = $payload->precioVenta;
        $gestor_producto->existencia = $payload->existencia;

        if ($gestor_producto->setProductos()) {
            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Producto creado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Error al guardar"]);
        }
        break;

    case 'PUT':
        if ($total_segmentos !== 2 || !$id_recurso) {
            http_response_code(400);
            echo json_encode(["message" => "ID del producto ausente o ruta errónea"]);
            exit;
        }

        $payload = json_decode(file_get_contents("php://input"));
        $fallos_validacion = [];

        if (empty($payload->nombreproducto)) {
            $fallos_validacion[] = "El nombre del producto es obligatorio";
        }
        if (!isset($payload->precioCompra) || $payload->precioCompra < 0) {
            $fallos_validacion[] = "Precio de compra inválido";
        }
        if (!isset($payload->precioVenta) || $payload->precioVenta < 0) {
            $fallos_validacion[] = "Precio de venta inválido";
        }
        if (!isset($payload->existencia) || $payload->existencia < 0) {
            $fallos_validacion[] = "Existencia inválida";
        }
        if (isset($payload->precioVenta, $payload->precioCompra) && $payload->precioVenta < $payload->precioCompra) {
            $fallos_validacion[] = "El precio de venta no puede ser menor al de compra";
        }

        if (!empty($fallos_validacion)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "errores" => $fallos_validacion]);
            exit;
        }

        $gestor_producto->idProducto = $id_recurso;
        $gestor_producto->nombreproducto = $payload->nombreproducto;
        $gestor_producto->descripcion = $payload->descripcion;
        $gestor_producto->precioCompra = $payload->precioCompra;
        $gestor_producto->precioVenta = $payload->precioVenta;
        $gestor_producto->existencia = $payload->existencia;

        if ($gestor_producto->updateProductos()) {
            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Actualizado"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Error al actualizar"]);
        }
        break;

    case 'DELETE':
        if ($total_segmentos === 2 && $id_recurso) {
            $gestor_producto->idProducto = $id_recurso;

            if ($gestor_producto->borrarProducto()) {
                http_response_code(200);
                echo json_encode(["message" => "Producto eliminado"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "No se pudo eliminar"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Falta especificar el ID para procesar la baja"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido o ruta inválida"]);
        break;
}
?>