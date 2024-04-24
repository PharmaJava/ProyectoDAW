<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Reacciones Adversas</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css"> <!-- Ajusta la ruta según tu estructura de proyecto -->
</head>
<body>
    <div class="full-page-form">
        <h1>Registro de Reacciones Adversas a Medicamentos</h1>
        <form action="../controllers/ReaccionesController.php" method="post">
        
            <input type="hidden" name="medicamento_id" value="ID_DEL_MEDICAMENTO">
            <label for="paciente_id">ID del Paciente:</label>
            <input type="text" id="paciente_id" name="paciente_id" required>
            
            <label for="medicamento_id">ID del Medicamento Registrado:</label>
            <input type="text" id="medicamento_id" name="medicamento_id" required>

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

            <button type="submit" name="submit">Registrar Reacción</button>
            <a href="pacientesuccess.php" class="btn">Volver</a>
        </form>
    </div>
</body>
</html>
