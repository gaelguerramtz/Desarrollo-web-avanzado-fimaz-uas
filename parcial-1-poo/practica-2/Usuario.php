<?php

    class Usuario {
        private $nombre;
        private $correo;

        function __construct($nombre, $correo) {
            $this->nombre = $nombre;
            $this->correo = $correo;
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
            $this->correo = $nuevoCorreo;
        }
    }

?>