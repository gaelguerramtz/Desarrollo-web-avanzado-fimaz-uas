<?php
require_once 'Clases.php';

$usuarios = [];
$errorMs = "";

try {
    //valido administrador  
    $usuarios[] = new Admin("alverto juarez", "j.juarez@gmail.com");

    //Alumno valido 
    $usuarios[] = new Alumno("Maria Perez", "maria.perez@gmail.com", "20240001");

    //Usuario invalido 
    $usuarios[] = new Alumno("juan Martinez", "jmartinez@gmailcom", "20240002");

} catch (Exception $e) {
    // Captura y muestra un mensaje 
    $errorMs = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sistema de Usuarios - FIMAZ</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .error { color: white; background-color: #d9534f; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Lista de Usuarios Creados Correctamente</h2>

    <?php if ($errorMs): ?>
        <div class="error"><strong>Aviso:</strong> <?php echo $errorMs; ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Matrícula</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u->getNombre(); ?></td>
                    <td><?php echo $u->getCorreo(); ?></td>
                    <td><?php echo $u->getRol(); ?></td>
                    <td><?php echo ($u instanceof Alumno) ? $u->getMatricula() : "N/A"; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>