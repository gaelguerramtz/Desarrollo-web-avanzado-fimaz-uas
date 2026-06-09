<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Administracion de productos</h2>
    <div>
        <a href="index.php?route=productos/create" class="btn btn-success">Nuevo producto</a>
        <a href="index.php?route=logout" class="btn btn-danger">Cerrar sesion</a>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>SKU</th>
            <th>Nombre</th>
            <th>Precio compra</th>
            <th>Precio venta</th>
            <th>Existencia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= (int)$producto['id']; ?></td>
                <td><?= htmlspecialchars($producto['sku']); ?></td>
                <td><?= htmlspecialchars($producto['nombre']); ?></td>
                <td>$<?= number_format((float)$producto['precio_compra'], 2); ?></td>
                <td>$<?= number_format((float)$producto['precio_venta'], 2); ?></td>
                <td><?= (int)$producto['existencia']; ?></td>
                <td>
                    <a href="index.php?route=productos/edit&id=<?= (int)$producto['id']; ?>"
                    class="btn btn-primary btn-sm">Editar</a>

                    <form action="index.php?route=productos/delete" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= (int)$producto['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm"
                         onclick="return confirm('¿Deseas eliminar este producto?');">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
