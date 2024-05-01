<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Otros Medicamentos</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="date"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        button[type="submit"]:hover,
        .btn:hover {
            background-color: #0056b3;
        }

        .btn {
            text-decoration: none;
            color: #007bff;
            background-color: transparent;
            border: 1px solid #007bff;
            border-radius: 4px;
            padding: 10px 20px;
            margin-right: 10px;
        }

        .btn:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Registro de Otros Medicamentos</h1>
    <form action="../controllers/OtrosMedicamentosController.php" method="post">
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

        <button type="submit" name="submit">Registrar y volver al menú</button>
        <a href="AdminDashboard.php" class="btn">Volver</a>
    </form>
</div>
</body>
</html>
