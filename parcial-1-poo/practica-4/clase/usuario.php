<?php
class Usuario {
    // Cambiamos de private a protected para permitir herencia
    protected $nombre;
    protected $correo;

    function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        
        // Validación robusta usando filtro de PHP
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->correo = $correo;
        } else {
            // Lanzamos excepción para que el bloque try/catch de index.php la capture
            throw new Exception("El correo '$correo' no tiene un formato válido.");
        }
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }
}
?>