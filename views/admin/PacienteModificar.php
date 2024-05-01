<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Paciente</title>
    <link rel="stylesheet" href="../../assets/css/stylee.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
        /* Estilos para el formulario */
        .full-page-form {
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
        select {
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
<div class="full-page-form">
    <?php
     require_once '..\..\config\db.php';
     require_once '../paciente/modelspaciente.php';

    session_start(); // Iniciar sesión

    if (!isset($_SESSION['usuario_id'])) {
        // Si no está autenticado, redirigir al inicio de sesión
        header('Location: index.php');
        exit();
    }

    $paciente = new Paciente();

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Intento de actualizar el paciente
        $paciente_id = $_POST['paciente_id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $sexo = $_POST['sexo'];
        $edad = $_POST['edad'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];

        $resultado = $paciente->actualizarPaciente($paciente_id, $nombre, $apellidos, $sexo, $edad, $peso, $altura);

        if ($resultado) {
            echo "<p>Paciente actualizado correctamente.</p>";
            header("Location: Adminpacientes.php");
        } else {
            echo "<p>Error al actualizar los datos del paciente.</p>";
            header("Location: PacienteModificar.php");
        }
    } else if (isset($_POST['paciente_id'])) {
        // Mostrar el formulario con los datos actuales del paciente
        $paciente_info = $paciente->getPacienteById($_POST['paciente_id']);

        if ($paciente_info) {
            ?>
            <h2>Modificar Paciente</h2>
            <p>Modificando paciente ID: <?php echo $paciente_info['paciente_id']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="paciente_id" value="<?php echo $paciente_info['paciente_id']; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $paciente_info['nombre']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $paciente_info['apellidos']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo" required>
                        <option value="masculino" <?php echo $paciente_info['sexo'] == 'masculino' ? 'selected' : ''; ?>>Masculino</option>
                        <option value="femenino" <?php echo $paciente_info['sexo'] == 'femenino' ? 'selected' : ''; ?>>Femenino</option>
                        <option value="otro" <?php echo $paciente_info['sexo'] == 'otro' ? 'selected' : ''; ?>>Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" value="<?php echo $paciente_info['edad']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="peso">Peso:</label>
                    <input type="text" id="peso" name="peso" value="<?php echo $paciente_info['peso']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="altura">Altura:</label>
                    <input type="text" id="altura" name="altura" value="<?php echo $paciente_info['altura']; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn">Modificar</button>
            </form>
            <a href="Adminpacientes.php" class="btn">Volver</a>
            <?php
        } else {
            echo "<p>No se encontraron datos del paciente. Asegúrese de que el ID es correcto.</p>";
        }
    } else {
        echo "<p>No se ha proporcionado un ID de paciente válido.</p>";
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="script.js"></script>
</body>
</html>
