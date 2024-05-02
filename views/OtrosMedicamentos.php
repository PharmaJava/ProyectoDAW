<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Otros Medicamentos</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <div class="full-page-form">
       <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Otros Medicamentos</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
<div class="full-page-form">
        <h1>Registro de Otros Medicamentos</h1>
        <form action="../controllers/OtrosMedicamentosController.php" method="post">
            <label for="paciente_id">ID del Paciente:</label>
            <select id="paciente_id" name="paciente_id" required> </select>

            <label for="nombre_medicamento">Nombre del Medicamento:</label>
            <input type="text" id="nombre_medicamento" name="nombre_medicamento" required>

            <label for="posologia">Posología (cómo se utilizó el medicamento):</label>
            <textarea id="posologia" name="posologia" required></textarea>

            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin">

            <label for="uso_medicacion">Uso de la medicación (para qué se utilizó):</label>
            <textarea id="uso_medicacion" name="uso_medicacion" required></textarea>

            <button type="submit" name="submit">Registrar</button>
            <a href="success.php" class="btn">Volver</a>
        </form>
    </div>
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $.ajax({
        url: 'getPacientes.php',  
        type: 'GET',
        success: function(data) {
            var pacientes = JSON.parse(data);
            var pacienteSelect = $('#paciente_id');
            pacientes.forEach(function(paciente) {
                // Esto añade una opción al select con el nombre y el ID del paciente
                pacienteSelect.append(new Option(paciente.nombre + " (ID: " + paciente.paciente_id + ")", paciente.paciente_id));
            });
        },
        error: function() {
            alert('Error al cargar los pacientes');
        }
    });
});
</script>
</body>
</html>
