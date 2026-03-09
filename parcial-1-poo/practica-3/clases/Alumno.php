<?php
require_once 'Usuario.php';

class Alumno extends Usuario {
    private $idMatricula;

    public function __construct($nombre, $correo, $matricula) {
        parent::__construct($nombre, $correo);
        $this->idMatricula = $matricula;
    }

    public function obtenerPuesto() {
        return "Perfil: Alumno Académico";
    }
}
?>