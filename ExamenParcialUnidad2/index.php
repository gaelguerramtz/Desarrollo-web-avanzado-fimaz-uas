<?php
require_once 'autoload.php';

// gaelguerramartinez
$controller = new ProductoController();

$termino = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
$productos = ($termino != '') ? $controller->buscar($termino) : $controller->listar();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $controller->agregar($_POST['nombre'], $_POST['descripcion'], $_POST['existencia'], $_POST['precio']);
    header("Location: index.php");
    exit;
}

if (isset($_GET['eliminar'])) {
    $controller->eliminar($_GET['eliminar']);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD PDO - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Gestión de Productos</h2>
    <form method="GET" class="mb-3 row g-2">
        <div class="col-10"><input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="<?php echo htmlspecialchars($termino); ?>"></div>
        <div class="col-2"><button type="submit" class="btn btn-primary w-100">Buscar</button></div>
    </form>

    <form method="POST" class="card card-body mb-4">
        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" required>
        <textarea name="descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>
        <input type="number" name="existencia" placeholder="Stock" class="form-control mb-2" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control mb-2" required>
        <button type="submit" name="agregar" class="btn btn-success">Guardar</button>
    </form>

    <table class="table table-bordered">
        <thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Acciones</th></tr></thead>
        <tbody>
            <?php foreach($productos as $p): ?>
            <tr>
                <td><?php echo $p['id']; ?></td>
                <td><?php echo $p['nombre']; ?></td>
                <td>$<?php echo $p['precio']; ?></td>
                <td><a href="?eliminar=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>