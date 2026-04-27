<?php // gaelguerramartinez

class ProductoController {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function agregar($nombre, $descripcion, $existencia, $precio) {
        $sql = "INSERT INTO productos (nombre, descripcion, existencia, precio) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $existencia, $precio]);
    }

    public function listar() {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($termino) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE :t OR descripcion LIKE :t ORDER BY id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':t', '%' . $termino . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }
}