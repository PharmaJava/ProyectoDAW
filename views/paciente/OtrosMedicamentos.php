<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Otros Medicamentos</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css">
</head>
<body>
    <div class="full-page-form">
        <h1>Registro de Otros Medicamentos</h1>
        <form action="../../controllers/OtrosMedicamentosController.php" method="post">
            <label for="paciente_id">ID del Paciente:</label>
            <input type="text" id="paciente_id" name="paciente_id" required>

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
            <a href="pacientesuccess.php" class="btn">Volver</a>
        </form>
    </div>
</body>
</html>
