<?php
class Usuario {
    protected string $nombre; 
    protected string $correo; 

    public function __construct(string $nombre, string $correo) {
        // Validación de correo en el constructor 
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Error: El formato del correo '$correo' no es válido."); 
        }
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCorreo(): string {
        return $this->correo;
    }
}

// Clase Admin 
class Admin extends Usuario {
    public function getRol(): string {
        return "Administrador"; 
    }
}

// Clase Alumno igual a Usuario 
class Alumno extends Usuario {
    private string $matricula; 

    public function __construct(string $nombre, string $correo, string $matricula) {
        parent::__construct($nombre, $correo); // Llama al constructor para validar correo
        $this->matricula = $matricula;
    }

    public function getMatricula(): string {
        return $this->matricula; 
    }

    public function getRol(): string {
        return "Alumno"; 
    }
}
?>