<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Iniciar sesion
            </div>
            <div class="card-body">
                <form action="index.php?route=auth/login" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
