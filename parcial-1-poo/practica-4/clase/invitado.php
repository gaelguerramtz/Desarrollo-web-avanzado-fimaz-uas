<?php
require_once 'Usuario.php'; /*Se le permite a la clase Invitado tener acceso al código de Usuario.php*/
    class Invitado extends Usuario { /*La clase Invitado se hace hija de la clase Usuario*/
            private $empresa; /*Se declara la propiedad privada de empresa*/

            function __construct($nombre, $correo, $empresa)
        {
        parent::__construct($nombre, $correo); /*Llama al constructos de la clase padre, permite que la clase Alumno inicialice las propiedades heredadas de la clase Usuario, garantiza que se inicialice correctamente la clase padre antes de inicializar las propiedades específicas de la clase hija*/
        $this->empresa=$empresa; /*Establece el valor de empresa*/
        }

        function getEmpresa() { /*La funcion getEmpresa() nos regresa el valor de la propiedad empresa del objeto*/
        return $this->empresa;
    }

    public function getRol() { /*Función getRol nos regresa el rol de Invitado*/
        return "Invitado";
        }
    }