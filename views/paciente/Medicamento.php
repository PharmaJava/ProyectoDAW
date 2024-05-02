<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Medicamento</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
<div class="full-width-form">
    <h1>Registrar Medicamento</h1>
    <form action="../../controllers/MedicamentoController.php" method="post">
        <label for="paciente_id">ID del Paciente:</label>
        <select id="paciente_id" name="paciente_id" required>

        <label for="nombre_medicamento">Nombre del Medicamento:</label>
        <input type="text" id="nombre_medicamento" name="nombre_medicamento" required>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>

        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin">

        <label for="uso">Uso:</label>
        <input type="text" id="uso" name="uso" required>

        <label for="codigo_nacional">Código Nacional:</label>
        <input type="text" id="codigo_nacional" name="codigo_nacional">

        <label for="lote">Lote:</label>
        <input type="text" id="lote" name="lote">

        <label for="fecha_caducidad">Fecha de Caducidad:</label>
        <input type="date" id="fecha_caducidad" name="fecha_caducidad">

        <label for="posologia">Posología:</label>
        <textarea id="posologia" name="posologia"></textarea>

        <label for="via_administracion">Vía de Administración:</label>
        <select id="via_administracion" name="via_administracion">
            <option value="oral">Oral</option>
            <option value="parenteral">Parenteral</option>
            <option value="topica">Tópica</option>
            <option value="otra">Otra</option>
        </select>

        <input type="submit" name="submit" value="Registrar Medicamento">
        <a href="pacientesuccess.php" class="btn">Volver</a>
    </form>
    
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $.ajax({
        url: '../getpacientes.php',  
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
