<?php // gaelguerramartinez

class Producto {
    public $id;
    public $nombre;
    public $descripcion;
    public $existencia;
    public $precio;

    public function __construct($id=null, $nombre=null, $descripcion=null, $existencia=null, $precio=null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->existencia = $existencia;
        $this->precio = $precio;
    }
}