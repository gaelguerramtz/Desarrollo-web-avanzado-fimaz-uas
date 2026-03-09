<?php
// Asegúrate de que el require_once apunte a la ubicación real de Usuario.php.
// Si ambos archivos están en la carpeta /clases/, esto es correcto:
require_once 'Usuario.php'; 

class Admin extends Usuario {
    
    // Implementación del método polimórfico getRol()
    public function getRol() {
        return "Administrador";
    }
}
?>