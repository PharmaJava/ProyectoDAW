<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Reacciones Adversas</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css"> <!-- Ajusta la ruta según tu estructura de proyecto -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div class="full-page-form">
        <h1>Registro de Reacciones Adversas a Medicamentos</h1>
        <form action="../../controllers/ReaccionesController.php" method="post">
            <label for="paciente_id">ID del Paciente:</label>
            <input type="text" id="paciente_id" name="paciente_id" required list="pacientesList">
            <datalist id="pacientesList">
                <!-- Las opciones se llenarán dinámicamente por JavaScript -->
            </datalist>

            <label for="medicamento_id">ID del Medicamento Registrado:</label>
            <select id="medicamento_id" name="medicamento_id" required>
                <!-- Las opciones se llenarán dinámicamente por JavaScript -->
            </select>

            <label for="sintoma">Síntoma:</label>
            <textarea id="sintoma" name="sintoma" required></textarea>

            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="fecha_fin">Fecha de finalización:</label>
            <input type="date" id="fecha_fin" name="fecha_fin">

            <label for="estado_actual">Estado actual:</label>
            <select id="estado_actual" name="estado_actual" required>
                <option value="resuelto">Resuelto</option>
                <option value="pendiente">Pendiente</option>
                <option value="en tratamiento">En tratamiento</option>
                <option value="otro">Otro</option>
            </select>

            <label for="otros_datos">Otros datos de interés:</label>
            <textarea id="otros_datos" name="otros_datos"></textarea>

            <button type="submit"class='btn btn-modificar' name="submit">Registrar Reacción</button>
            <a href="AdminDashboard.php" class="btn">Volver</a>
        </form>
    </div>
    <script>
$(document).ready(function() {
    // Cargar inicialmente todos los pacientes
    $.ajax({
        url: '../getPacientes.php', // Ajusta esta URL a la ruta correcta
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

    // Evento cuando cambia el valor del campo paciente_id
    $('#paciente_id').change(function() {
        var pacienteId = $(this).val(); // Obtiene el ID del paciente seleccionado

        $.ajax({
            url: '../medicamentosPorPaciente.php', // Ajusta esta URL a la ruta correcta
            type: 'GET',
            data: { paciente_id: pacienteId },
            success: function(data) {
                var medicamentos = JSON.parse(data);
                var medicamentoIdSelect = $('#medicamento_id');
                medicamentoIdSelect.empty(); // Limpia el campo anterior

                if(medicamentos.length > 0) {
                    $.each(medicamentos, function(i, medicamento) {
                        medicamentoIdSelect.append(new Option(medicamento.nombre_medicamento, medicamento.medicamento_id));
                    });
                } else {
                    medicamentoIdSelect.append(new Option('No se encontraron medicamentos', ''));
                }
            },
            error: function() {
                alert('Error al cargar los medicamentos');
            }
        });
    });
});
</script>

</body>
</html>
