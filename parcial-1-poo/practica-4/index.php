<?php
require_once "clases/Admin.php";
require_once "clases/Alumno.php";
require_once "clases/Invitado.php";

$usuarios = [];
$error = "";

try {
    $usuarios[] = new Admin("Brant Santana", "admin@correo.com");
    $usuarios[] = new Alumno("Juan Perez", "alumno@correo.com", "20231234");
    $usuarios[] = new Invitado("Maria Lopez", "invitado@empresa.com", "Google");

    // Usuario con correo inválido para probar excepción
    $usuarios[] = new Alumno("Usuario Error", "correo_mal", "0000");

} catch (Exception $e) {
    $error = "Error controlado: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Práctica 4</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Lista de Usuarios</h2>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<table>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Matrícula</th>
        <th>Empresa</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u->getNombre() ?></td>
        <td><?= $u->getCorreo() ?></td>
        <td><?= $u->getRol() ?></td>
        <td><?= method_exists($u, 'getMatricula') ? $u->getMatricula() : "—" ?></td>
        <td><?= method_exists($u, 'getEmpresa') ? $u->getEmpresa() : "—" ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>