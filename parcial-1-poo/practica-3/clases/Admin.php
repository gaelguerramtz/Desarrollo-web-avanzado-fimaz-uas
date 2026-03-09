<?php

    require_once 'Usuario.php'; //Se importa este archivo para usar la clase Usuario como clase padre

    class Admin extends Usuario {

        public function getRol() {
            return "Administrador";
        }
    }
?>