<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Otros Medicamentos</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Otros Medicamentos</h1>
        <form action="../controllers/OtrosMedicamentosController.php" method="post">
            <!-- Aquí asumo que ya tienes una manera de saber el id del paciente -->
            <input type="hidden" name="paciente_id" value="<?php echo $_SESSION['paciente_id']; ?>">

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

            <button type="submit" name="submit">Registrar y volver al menu</button>
        </form>
    </div>
</body>
</html>
