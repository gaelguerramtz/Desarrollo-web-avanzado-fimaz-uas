<?php
// Ajuste de ruta: si Alumno.php está dentro de /clases, 
// el require debe buscar Usuario.php en la misma carpeta.
require_once 'Usuario.php'; 

class Alumno extends Usuario {
    private $matricula;

    public function __construct($nombre, $correo, $matricula) {
        // Llama al constructor de la clase padre (Usuario)
        parent::__construct($nombre, $correo);
        $this->matricula = $matricula;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    // Polimorfismo: implementa el método esperado en el sistema
    public function getRol() {
        return "Alumno";
    }
}
?>