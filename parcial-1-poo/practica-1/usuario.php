<?php
// Paso 2. Implementar la clase Usuario [cite: 31, 32]
class Usuario {
    // Atributos privados [cite: 34]
    private $nombre;
    private $correo;

    // Constructor para inicializar atributos [cite: 38, 41]
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }

    // Métodos Getter [cite: 42]
    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }

    // Métodos Setter [cite: 43]
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}
?>