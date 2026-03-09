<?php

require_once 'clases/Admin.php'; 
require_once 'clases/Alumno.php';
    function validarAdmin($nombreAdmin, $correo) {
        try {
            $admin = new Admin($nombreAdmin, $correo);
            echo "Administrador {$nombreAdmin} validado con correo: {$correo} <br>";
            return $admin;
        } catch (Exception $e) {
            echo "Error al validar Administrador {$nombreAdmin}: {$e->getMessage()} <br>";
        }
    }

    function validarAlumno($nombreAlumno, $correo, $matricula) {
        try {
            $alumno = new Alumno($nombreAlumno, $correo, $matricula);
            echo "Alumno {$nombreAlumno} validado con correo: {$correo} y matricula: {$matricula} <br>";
            return $alumno;
        } catch (Exception $e) {
            echo "Error al validar Alumno {$nombreAlumno}: {$e->getMessage()} <br>";
        }
    }

    $objAdmin01 = validarAdmin("Marco", "1234#gmail,com");
    $objAdmin02 = validarAdmin("manu", "manulas@gmail.com");
    $objAlumno01 = validarAlumno("Bruno sanchez", "salas23@gmail.com", "25060021");
    $objAlumno02 = validarAlumno("Juan Hernandez", "rodrio#gmail,com", "12345678910");
?>