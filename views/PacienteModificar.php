<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Paciente</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php
        require_once __DIR__ . '/../config/db.php';
        require_once '../models/Paciente.php';

        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            // Si el usuario no está autenticado, redirige al inicio de sesión
            header('Location: index.php');
            exit();
        }

        // Obtener el paciente_id de la solicitud POST
        if (isset($_POST['paciente_id'])) {
            $paciente_id = $_POST['paciente_id'];

            // Crear una instancia de la clase Paciente y obtener los datos del paciente
            $paciente = new Paciente();
            $paciente_info = $paciente->getPacienteById($paciente_id);
        } else {
            // Si no se proporcionó un paciente_id válido, mostrar un mensaje de error
            echo "<p>No se ha proporcionado un ID de paciente válido.</p>";
            exit();
        }

        // Verificar si se han enviado los datos del formulario de modificación
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["paciente_id"])) {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $sexo = $_POST['sexo'];
            $edad = $_POST['edad'];
            $peso = $_POST['peso'];
            $altura = $_POST['altura'];

            // Actualizar los datos del paciente en la base de datos
            $result = $paciente->actualizarPaciente($_POST['paciente_id'], $nombre, $apellidos, $sexo, $edad, $peso, $altura);

            // Verificar si la actualización fue exitosa
            if ($result) {
                // Redirigir a la página de éxito
                header("Location: success.php");
                exit();
            } else {
                // Mostrar un mensaje de error si la actualización falló
                echo "Error al actualizar el paciente.";
            }
        }
        ?>
        <h2>Modificar Paciente</h2>
        <p>Modificando paciente ID: <?php echo $paciente_info['paciente_id']; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="paciente_id" value="<?php echo $paciente_info['paciente_id']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($paciente_info['nombre']) ? $paciente_info['nombre'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($paciente_info['apellidos']) ? $paciente_info['apellidos'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="masculino" <?php echo isset($paciente_info['sexo']) && $paciente_info['sexo'] == 'masculino' ? 'selected' : ''; ?>>Masculino</option>
                    <option value="femenino" <?php echo isset($paciente_info['sexo']) && $paciente_info['sexo'] == 'femenino' ? 'selected' : ''; ?>>Femenino</option>
                    <option value="otro" <?php echo isset($paciente_info['sexo']) && $paciente_info['sexo'] == 'otro' ? 'selected' : ''; ?>>Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" value="<?php echo isset($paciente_info['edad']) ? $paciente_info['edad'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="peso">Peso:</label>
                <input type="number" id="peso" name="peso" value="<?php echo isset($paciente_info['peso']) ? $paciente_info['peso'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="altura">Altura:</label>
                <input type="number" id="altura" name="altura" value="<?php echo isset($paciente_info['altura']) ? $paciente_info['altura'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn">Modificar</button>
        </form>
        <a href="PacientesRegistrados.php" class="btn">Volver</a>
    </div>
</body>
</html>
