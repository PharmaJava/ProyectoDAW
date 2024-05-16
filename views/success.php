
<?php  // Esto asegura que la sesión está iniciada 
require_once __DIR__ . '/../config/db.php';
require_once '../models/Usuario.php';
session_start();
 // Verificar si el usuario está autenticado y si tiene el rol de sanitario
 if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'sanitario') {
    header('Location: ../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <div class="full-width-form">
    <?php if(isset($_SESSION['username']) && isset($_SESSION['usuario_id'])): ?>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']);     ?>.
    <!-- (ID: <?php echo $_SESSION['usuario_id']; ?>)!</h1> -->
    <?php else: ?>
        <h1>Bienvenido!</h1>
    <?php endif; ?>
    <br>
                <h2>Dashboard de Sanitario:</h2>
        <p>Selecciona una opción para continuar.</p>
        <br>
        <div class="next-steps">
            <a href="Paciente.php" class="button">Registrar a un paciente</a>
            <a href="PacientesRegistrados.php" class="button">Paciente que has registrado</a>
            <br>
            <a href="Medicamento.php" class="button">Medicamento que dió la reacción</a>
            <a href="MedicamentosRegistrados.php" class="button">Medicamento registrados con reacción</a>
            <br>
            <a href="reacciones.php" class="button">Registrar la reacción adversa</a>
            <a href="OtrosMedicamentos.php" class="button">Medicación Crónica </a>
            <br>
            
            <form action="logout.php" method="post">
                <button type="submit" class="button">Cerrar Sesión</button>
            </form>
        </div>
    </div>
    </div>

</body>
</html>
