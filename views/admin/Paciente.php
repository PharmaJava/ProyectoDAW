<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Paciente</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
   
</head>
<body>
<div class="full-page-form">
    <h1>Formulario de Registro de Paciente</h1>
    <form action="../../controllers/PacienteController.php" method="post">
        <!-- Este input podría estar oculto si estás pasando el usuario_id directamente -->
        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id']; // Asegúrate de que esta variable existe y es correcta ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>

        <label for="peso">Peso (kg):</label>
        <input type="text" id="peso" name="peso" required>

        <label for="altura">Altura (cm):</label>
        <input type="text" id="altura" name="altura" required>

        <input type="submit" name="submit"class='btn btn-modificar'value="Registrar">
        <a href="AdminDashboard.php" class="btn">Volver</a>
    </form>
</div>

<script>
    // Script para cambiar el color del botón al pasar el cursor sobre él
    var btn = document.querySelector('.btn');
    btn.addEventListener('mouseover', function() {
        btn.style.backgroundColor = '#45a049';
    });
    btn.addEventListener('mouseout', function() {
        btn.style.backgroundColor = '#4CAF50';
    });
</script>
</body>
</html>
