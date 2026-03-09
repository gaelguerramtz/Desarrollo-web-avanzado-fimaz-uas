<?php
class Usuario {
    private $nombreUsuario;
    private $emailUsuario;

    public function __construct($nombre, $correo) {
        $this->nombreUsuario = $nombre;
        
        // Validación personalizada
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del correo electrónico es incorrecto.");
        }
        $this->emailUsuario = $correo;
    }

    public function obtenerNombre() { return $this->nombreUsuario; }
    public function obtenerEmail() { return $this->emailUsuario; }

    public function modificarEmail($nuevoCorreo) {
        if (filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {
            $this->emailUsuario = $nuevoCorreo;
        } else {
            throw new Exception("No se pudo actualizar: correo inválido.");
        }
    }
}
?>