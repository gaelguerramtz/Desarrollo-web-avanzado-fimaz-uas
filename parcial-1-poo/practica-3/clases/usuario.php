<?php

    class Usuario {
        private $nombre;
        private $correo;

        function __construct($nombre, $correo) {
            $this->nombre = $nombre;
            
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $this->correo = $correo;
            } else {
                throw new Exception("Correo invalido");
            }
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getCorreo() {
            return $this->correo;
        }

        public function setNombre($nuevoNombre) {
            $this->nombre = $nuevoNombre;
        }

        public function setCorreo($nuevoCorreo) {
            if (filter_var($nuevoCorreo, FILTER_VALIDATE_EMAIL)) {
                $this->correo = $nuevoCorreo;
            } else {
                throw new Exception("Correo invalido");
            }
        }
    }

?>