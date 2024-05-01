<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Reacciones Adversas</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css"> <!-- Ajusta la ruta según tu estructura de proyecto -->
    <style>
        /* Estilos para el formulario */
        .full-width-form {
            width: 50%;
            margin: 0 auto;
        }
        form {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        input[type="submit"]:hover,
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="full-width-form">
    <h1>Registro de Reacciones Adversas a Medicamentos</h1>
    <form action="../../controllers/ReaccionesController.php" method="post">
        
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
        <a href="AdminDashboard.php" class="btn">Volver</a>
    </form>
</div>

<script>
 
    document.addEventListener('DOMContentLoaded', function() {
      
        console.log('El DOM ha sido cargado');
    });
</script>
</body>
</html>
