<?php
    require_once 'Admin.php';

    // Instancia de Admin
    $objAdmin01 = new Admin("rejelio  remes", "leo@gmail.com");
    
    $nombreAdmin01 = $objAdmin01->getNombre();
    $correoAdmin01 = $objAdmin01->getCorreo();
    $rolAdmin01 = $objAdmin01->getRol();

    echo "Nombre: $nombreAdmin01<br>";
    echo "Correo: $correoAdmin01<br>";
    echo "Rol: $rolAdmin01<br>"; // Se añadió el punto y coma faltante
?>