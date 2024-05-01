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
            <input type="text" id="paciente_id" name="paciente_id" required list="pacientesList">
            <datalist id="pacientesList">
                <!-- Las opciones se llenarán dinámicamente por JavaScript -->
            </datalist>

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
    <script>
$(document).ready(function() {
    // Cargar inicialmente todos los pacientes
    $.ajax({
    url: 'getPacientesporUsuarios.php', 
    type: 'GET',
    success: function(data) {
            var pacientes = JSON.parse(data);
            var pacientesList = $('#pacientesList');
            pacientes.forEach(function(paciente) {
                pacientesList.append(new Option(paciente.nombre, paciente.paciente_id)); 
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

