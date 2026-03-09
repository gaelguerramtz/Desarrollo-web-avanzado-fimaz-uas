<?php

    require_once 'Usuario.php'; //Se importa este archivo para usar la clase Usuario como clase padre

    class Alumno extends Usuario {
        private $matricula;

        public function __construct($nombre, $correo, $matricula) {
            parent::__construct($nombre, $correo);
            $this->matricula = $matricula;
        }

        public function getRol() {
            return "Alumno";
        }
    }
?>