<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <!-- Prevenir el caché del navegador -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>
<div class="full-width-form">
    <?php
    session_start();
    // Redirecciona si no está logueado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../index.php");
        exit();
    }

    // Saludar al usuario por su nombre y mostrar el ID del paciente si está disponible
    echo '<h1>Bienvenido, ' . htmlspecialchars($_SESSION['username']); echo '.';
    // if (isset($_SESSION['paciente_id'])) {
    //     echo ' (Paciente ID: ' . $_SESSION['paciente_id'] . ')';
    // }
    echo '</h1>';
    ?>
            <h2>Dashboard de Paciente:</h2>
    <p>Selecciona una opción para continuar.</p>
    <div class="next-steps">
        <a href="PacientesRegistrados.php" class="button">Tus Datos</a>
        <br>
        <a href="Medicamento.php" class="button">Medicamento que dió la reacción</a>
        <a href="MedicamentosRegistrados.php" class="button">Medicamentos registrados con reacción</a>
        <br>
        <a href="reacciones.php" class="button">Registrar la reacción adversa</a>
        <a href="OtrosMedicamentos.php" class="button">Medicación Crónica</a>
        <form action="../logout.php" method="post">
            <button type="submit" class="button">Cerrar Sesión</button>
        </form>
    </div>
</div>
</body>
</html>
