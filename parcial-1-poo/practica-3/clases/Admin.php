<?php
require_once 'Usuario.php';

class Admin extends Usuario {
    // Método con nombre distinto y retorno descriptivo
    public function obtenerPuesto() {
        return "Perfil: Administrador de Sistema";
    }
}
?>