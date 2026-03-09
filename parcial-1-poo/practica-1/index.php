<?php
require_once 'Usuario.php';

$usuario = new Usuario("Gael Guerra", "gael.guerra@uas.edu.mx");

echo "<h1>Practica1: POO en PHP</h1>";

echo "<p><strong>Nombre:</strong> " . $usuario->getNombre() . "</p>";
echo "<p><strong>Correo:</strong> " . $usuario->getCorreo() . "</p>";
?>