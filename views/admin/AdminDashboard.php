
<?php  // Esto asegura que la sesión está iniciada 
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Usuario.php';

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
    <?php if(isset($_SESSION['username']) && isset($_SESSION['usuario_id'])): ?>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> (ID: <?php echo $_SESSION['usuario_id']; ?>)!</h1>
    <?php else: ?>
        <h1>Bienvenido!</h1>
    <?php endif; ?>
    <br>
        <p>ADMIN DASHBOARD.</p>
        <br>
        <div class="next-steps">
            <a href="Paciente.php" class="button">Registrar a un paciente</a>
            <br>
            <a href="PacientesRegistrados.php" class="button">Paciente que has registrado</a>
            <br>
            <a href="Medicamento.php" class="button">Medicamento que dió la reacción</a>
            <br>
            <a href="MedicamentosRegistrados.php" class="button">Medicamento que has registrado</a>
            <br>
            <a href="reacciones.php" class="button">Registrar la reacción adversa</a>
            <br>
            <a href="OtrosMedicamentos.php" class="button">Si tomas otro medicamento aunque no te haya dado reacción, haz clic aquí</a>
            <br>
            <a href="AdminPacientes.php" class="button">Administrar Pacientes</a>
            <br>
            <a href="AdminMedicamentos.php" class="button">Administrar Medicamentos</a>
            <br>
            <a href="AdminReacciones.php" class="button">Administrar Reacciones Adversas</a>
            <br>
            <a href="AdminOtrosMedicamentos.php" class="button">Administrar Otros Medicamentos</a>
            <br>
            
            <!-- Botón de cerrar sesión -->
            <form action="../logout.php" method="post">
                <button type="submit" class="button">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>