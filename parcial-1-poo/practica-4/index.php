<?php
// Carga las clases desde la carpeta 'clases/'
require_once "clases/Admin.php";
require_once "clases/Alumno.php";
require_once "clases/Invitado.php";

$usuarios = [];
$error = "";

try {
    // Intentar crear objetos válidos
    $usuarios[] = new Admin("Brant Santana", "admin@correo.com");
    $usuarios[] = new Alumno("Juan Perez", "alumno@correo.com", "20231234");
    $usuarios[] = new Invitado("Maria Lopez", "invitado@empresa.com", "Google");

    // Registro inválido para probar excepción (esto debe disparar el catch)
    $usuarios[] = new Alumno("Usuario Error", "correo_mal", "0000");

} catch (Exception $e) {
    $error = "Error controlado: " . $e->getMessage();
}
?>