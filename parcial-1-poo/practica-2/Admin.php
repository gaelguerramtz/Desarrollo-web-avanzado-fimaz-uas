<?php

    require_once 'Usuario.php';

    class Admin extends Usuario {    

        function getRol() {
            return "Administrador";
        }
    }
?>