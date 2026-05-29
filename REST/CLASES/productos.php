<?php
class Productos {

    private $db_conexion;

    private $nombre_tabla = "productos";

    public $idProducto;
    public $nombreproducto;
    public $descripcion;
    public $precioCompra;
    public $precioVenta;
    public $existencia;

    public function __construct($instancia_bd) 
    {
        $this->db_conexion = $instancia_bd;
    }

    public function setProductos() 
    {
        $query_construido = "INSERT INTO " . $this->nombre_tabla . " 
                             SET nombreproducto = :nombreproducto, 
                                 descripcion = :descripcion, 
                                 precioCompra = :precioCompra, 
                                 precioVenta = :precioVenta, 
                                 existencia = :existencia";

        $sentencia = $this->db_conexion->prepare($query_construido);
        
        $this->nombreproducto = htmlspecialchars(strip_tags($this->nombreproducto));
        $this->descripcion    = htmlspecialchars(strip_tags($this->descripcion));
        $this->precioCompra   = htmlspecialchars(strip_tags($this->precioCompra));
        $this->precioVenta    = htmlspecialchars(strip_tags($this->precioVenta));
        $this->existencia     = htmlspecialchars(strip_tags($this->existencia));

        $sentencia->bindParam(":nombreproducto", $this->nombreproducto);
        $sentencia->bindParam(":descripcion", $this->descripcion);
        $sentencia->bindParam(":precioCompra", $this->precioCompra);
        $sentencia->bindParam(":precioVenta", $this->precioVenta);
        $sentencia->bindParam(":existencia", $this->existencia);

        return (bool)$sentencia->execute();
    }

    public function updateProductos() 
    {
        $query_construido = "UPDATE " . $this->nombre_tabla . " 
                             SET nombreproducto = :nombreproducto, 
                                 descripcion = :descripcion, 
                                 precioCompra = :precioCompra, 
                                 precioVenta = :precioVenta, 
                                 existencia = :existencia 
                             WHERE idProducto = :idProducto";

        $sentencia = $this->db_conexion->prepare($query_construido);
        
        $this->idProducto     = htmlspecialchars(strip_tags($this->idProducto));
        $this->nombreproducto = htmlspecialchars(strip_tags($this->nombreproducto));
        $this->descripcion    = htmlspecialchars(strip_tags($this->descripcion));
        $this->precioCompra   = htmlspecialchars(strip_tags($this->precioCompra));
        $this->precioVenta    = htmlspecialchars(strip_tags($this->precioVenta));
        $this->existencia     = htmlspecialchars(strip_tags($this->existencia));

        $sentencia->bindParam(":idProducto", $this->idProducto);
        $sentencia->bindParam(":nombreproducto", $this->nombreproducto);
        $sentencia->bindParam(":descripcion", $this->descripcion);
        $sentencia->bindParam(":precioCompra", $this->precioCompra);
        $sentencia->bindParam(":precioVenta", $this->precioVenta);
        $sentencia->bindParam(":existencia", $this->existencia);

        return (bool)$sentencia->execute();
    }

    public function getProductos() 
    {
        $query_construido = "SELECT idProducto, nombreproducto, descripcion, precioCompra, precioVenta, existencia 
                             FROM " . $this->nombre_tabla;

        $sentencia = $this->db_conexion->prepare($query_construido);
        $sentencia->execute();

        return $sentencia;
    }

    public function getProducto() 
    {
        $query_construido = "SELECT idProducto, nombreproducto, descripcion, precioCompra, precioVenta, existencia 
                             FROM " . $this->nombre_tabla . " 
                             WHERE idProducto = ? 
                             LIMIT 0,1";

        $sentencia = $this->db_conexion->prepare($query_construido);
        $sentencia->bindParam(1, $this->idProducto);
        $sentencia->execute();

        $registro_encontrado = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($registro_encontrado) {
            $this->nombreproducto = $registro_encontrado['nombreproducto'];
            $this->descripcion    = $registro_encontrado['descripcion'];
            $this->precioCompra   = $registro_encontrado['precioCompra'];
            $this->precioVenta    = $registro_encontrado['precioVenta'];
            $this->existencia     = $registro_encontrado['existencia'];
            return true;
        }

        return false;
    }

    public function borrarProducto() 
    {
        $query_construido = "DELETE FROM " . $this->nombre_tabla . " 
                             WHERE idProducto = ?";

        $sentencia = $this->db_conexion->prepare($query_construido);
        $sentencia->bindParam(1, $this->idProducto);

        return (bool)$sentencia->execute();
    }
}
?>