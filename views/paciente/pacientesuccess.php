
<?php  // Esto asegura que la sesión está iniciada 
require_once __DIR__ . '/../../config/db.php';
require_once '../../models/Usuario.php';
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css">
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['username'])): ?>
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>
            <?php if (isset($_SESSION['paciente_id'])): ?>
                (ID: <?php echo $_SESSION['paciente_id']; ?>)
            <?php endif; ?>
        </h1>
    <?php else: ?>
        <h1>Bienvenido!</h1>
    <?php endif; ?>
    <br>

        <p>Selecciona una opción para continuar.</p>
        <br>
        <div class="next-steps">
            <a href="Paciente.php" class="button">OBLIGATORIO: Completa tus datos </a>
            <br>
            <a href="PacientesRegistrados.php" class="button">Tu registro</a>
            <br>
            <a href="Medicamento.php" class="button">Medicamento que dió la reacción</a>
            <br>
            <a href="MedicamentosRegistrados.php" class="button">Medicamento que has registrado</a>
            <br>
            <a href="reacciones.php" class="button">Registrar la reacción adversa</a>
            <br>
            <a href="OtrosMedicamentos.php" class="button">Si tomas otro medicamento aunque no te haya dado reacción, haz clic aquí</a>
            <br>
            
         
            <form action="../logout.php" method="post">
                <button type="submit" class="button">Cerrar Sesión</button>
            </form>
        </div>
    </div>
    </div>


</body>
</html>
