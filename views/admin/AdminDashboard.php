<?php
// Esto asegura que la sesión está iniciada
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Usuario.php';

session_start();
 // Verificar si el usuario está autenticado y si tiene el rol de admin
 if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <style>
        /* Estilos adicionales para el elemento details */
        details {
            margin-bottom: 1rem;
            border: 1px solid #007bff;
            border-radius: 4px;
            overflow: hidden;
        }

        details[open] summary {
            border-bottom: 1px solid #007bff;
        }

        summary {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            cursor: pointer;
            user-select: none;
            font-size: 1rem;
        }

        summary:hover {
            background-color: #0056b3;
        }

        .admin-options {
            padding: 10px;
            background-color: #f9f9f9;
        }

        .admin-options a {
            display: block;
            margin: 5px 0;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .admin-options a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="full-width-form">
    <?php if(isset($_SESSION['username']) && isset($_SESSION['usuario_id'])): ?>
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>.
        <!-- (ID: <?php echo $_SESSION['usuario_id']; ?>)! -->
    </h1>
    <?php else: ?>
        <h1>Bienvenido!</h1>
    <?php endif; ?>
    <p>ADMIN DASHBOARD:</p>
    <div class="next-steps">
        <a href="Paciente.php" class="button">Registrar a un paciente</a>
        <a href="PacientesRegistrados.php" class="button">Paciente que has registrado</a>
        <br>
        <a href="Medicamento.php" class="button">Medicamento que dió la reacción</a>
        <a href="MedicamentosRegistrados.php" class="button">Medicamentos registrados con reacción</a>
        <br>
        <a href="Reacciones.php" class="button">Registrar la reacción adversa</a>
        <a href="OtrosMedicamentos.php" class="button">Medicación Crónica</a>
        <br>
        <!-- Sección de administración agrupada -->
        <details>
            <summary>Opciones de Administrador</summary>
            <div class="admin-options">
                <a href="AdminUsuarios.php">Administrar Usuarios</a>
                <a href="AdminPacientes.php">Administrar Pacientes</a>
                <a href="AdminMedicamentos.php">Administrar Medicamentos</a>
                <a href="AdminReacciones.php">Administrar Reacciones Adversas</a>
                <a href="AdminOtrosMedicamentos.php">Administrar Otros Medicamentos</a>
            </div>
        </details>

        <!-- Botón de cerrar sesión -->
        <form action="../logout.php" method="post">
            <button type="submit" class="button">Cerrar Sesión</button>
        </form>
    </div>
</div>
</body>
</html>
