<?php
// Esto asegura que la sesión está iniciada
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Usuario.php';

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrativo</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            margin-bottom: 20px;
            color: #666;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if(isset($_SESSION['username']) && isset($_SESSION['usuario_id'])): ?>
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> (ID: <?php echo $_SESSION['usuario_id']; ?>)!</h1>
    <?php else: ?>
        <h1>Bienvenido!</h1>
    <?php endif; ?>
    <p>ADMIN DASHBOARD.</p>
    <div class="next-steps">
        <a href="Paciente.php" class="button">Registrar a un paciente</a>
        <a href="PacientesRegistrados.php" class="button">Paciente que has registrado</a>
        <a href="Medicamento.php" class="button">Medicamento que dio la reacción</a>
        <a href="MedicamentosRegistrados.php" class="button">Medicamento que has registrado</a>
        <a href="Reacciones.php" class="button">Registrar la reacción adversa</a>
        <a href="OtrosMedicamentos.php" class="button">Registrar otro medicamento</a>
        <a href="AdminUsuarios.php" class="button">Administrar Usuarios</a>
        <a href="AdminPacientes.php" class="button">Administrar Pacientes</a>
        <a href="AdminMedicamentos.php" class="button">Administrar Medicamentos</a>
        <a href="AdminReacciones.php" class="button">Administrar Reacciones Adversas</a>
        <a href="AdminOtrosMedicamentos.php" class="button">Administrar Otros Medicamentos</a>

        <!-- Botón de cerrar sesión -->
        <form action="../logout.php" method="post">
            <button type="submit" class="button">Cerrar Sesión</button>
        </form>
    </div>
</div>
</body>
</html>
