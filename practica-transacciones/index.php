<?php
//CONFIGURACIÓN Y CONEXIÓN 
$host = "localhost";
$db   = "escuela";
$user = "root";
$pass = "";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Manejo de errores como excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$mensaje = "";
$detalle = "";

// PROCESAR FORMULARIO 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre   = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $correo   = trim($_POST["correo"] ?? "");
    $simularError = isset($_POST["simular_error"]);

    if ($nombre === "" || $apellido === "" || $correo === "") {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        try {
            // Iniciar transacción 
            $pdo->beginTransaction();

            // Insertar alumno 
            $sqlAlumno = "INSERT INTO alumnos (nombre, apellido, correo) VALUES (:nombre, :apellido, :correo)";
            $stmtAlumno = $pdo->prepare($sqlAlumno);
            $stmtAlumno->execute([
                "nombre"   => $nombre,
                "apellido" => $apellido,
                "correo"   => $correo
            ]);

            $idAlumno = (int)$pdo->lastInsertId();

            // 3) Simulación de error o insertar Log 
            if ($simularError) {
                throw new Exception("Simulación de error activada: se fuerza rollback.");
            } else {
                $sqlLog = "INSERT INTO logs_alumnos (idAlumno, accion) VALUES (:idAlumno, :accion)";
                $stmtLog = $pdo->prepare($sqlLog);
                $stmtLog->execute([
                    "idAlumno" => $idAlumno,
                    "accion"   => "ALTA_ALUMNO"
                ]);
            }

            // Confirmar cambios 
            $pdo->commit();
            $mensaje = "Transacción confirmada (COMMIT). Alumno registrado con ID: $idAlumno";

        } catch (Exception $e) {
            // Si algo falla, revertir todo 
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $mensaje = "Ocurrió un error. Transacción revertida (ROLLBACK).";
            $detalle = $e->getMessage();
        }
    }
}

// Consultas para mostrar las tablas
$alumnos = $pdo->query("SELECT * FROM alumnos ORDER BY idAlumno DESC")->fetchAll();
$logs    = $pdo->query("SELECT * FROM logs_alumnos ORDER BY idLog DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica PDO: try/catch y transacciones</title>
    <style>
        body{ font-family: Arial, sans-serif; margin: 20px; line-height: 1.4; }
        .card{ border: 1px solid #ddd; border-radius: 10px; padding: 16px; margin-bottom: 16px; }
        .row{ display: flex; gap: 12px; flex-wrap: wrap; }
        label{ display: block; font-weight: bold; margin-bottom: 6px; }
        input[type="text"], input[type="email"]{ width: 200px; padding: 8px; border: 1px solid #ccc; border-radius: 6px; }
        .btn{ padding: 10px 14px; border: 0; border-radius: 8px; cursor: pointer; background: #0b5ed7; color: white; }
        .msg{ padding: 10px; border-radius: 8px; background: #f5f5f5; margin-top: 10px; }
        .danger{ color: #b02a37; }
        table{ border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td{ border: 1px solid #ddd; padding: 8px; text-align: left; }
        th{ background: #f8f9fa; }
    </style>
</head>
<body>
    <h2>Práctica: try/catch y transacciones (PDO + MySQL)</h2>
    
    <div class="card">
        <form method="POST">
            <div class="row">
                <div>
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="">
                </div>
                <div>
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="">
                </div>
                <div>
                    <label>Correo</label>
                    <input type="email" name="correo" value="">
                </div>
            </div>
            <p>
                <label style="font-weight:normal">
                    <input type="checkbox" name="simular_error"> Simular error para forzar ROLLBACK
                </label>
            </p>
            <button class="btn" type="submit">Registrar alumno</button>
        </form>

        <?php if ($mensaje): ?>
            <div class="msg">
                <p><?php echo htmlspecialchars($mensaje); ?></p>
                <?php if ($detalle): ?>
                    <p class="danger"><small>Detalle: <?php echo htmlspecialchars($detalle); ?></small></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <h3>Tabla alumnos</h3>
        <table>
            <thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr></thead>
            <tbody>
                <?php foreach ($alumnos as $a): ?>
                    <tr><td><?= $a['idAlumno'] ?></td><td><?= $a['nombre'] ?></td><td><?= $a['apellido'] ?></td><td><?= $a['correo'] ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Tabla logs_alumnos</h3>
        <table>
            <thead><tr><th>ID Log</th><th>ID Alumno</th><th>Acción</th><th>Fecha</th></tr></thead>
            <tbody>
                <?php foreach ($logs as $l): ?>
                    <tr><td><?= $l['idLog'] ?></td><td><?= $l['idAlumno'] ?></td><td><?= $l['accion'] ?></td><td><?= $l['fecha'] ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>