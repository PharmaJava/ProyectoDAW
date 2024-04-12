<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos Registrados</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php
        require_once __DIR__ . '/../config/db.php';
        require_once '../models/Medicamento.php';
        require_once '../models/Paciente.php';

        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            // Si el usuario no está autenticado, redirige al inicio de sesión
            header('Location: index.php');
            exit();
        }

        // Obtener el nombre de usuario de la sesión (suponiendo que está almacenado allí)
        $nombre_usuario = $_SESSION['username']; // Asegúrate de que el nombre de usuario se guarda en la sesión al iniciar sesión

        echo "<h1>Pacientes Registrados por {$nombre_usuario}</h1>";
        echo "<br>";    
        // Crear una instancia de la clase Paciente
        $pacienteModel = new Paciente();
        $pacientes = $pacienteModel->getPacientesByUsuarioId($_SESSION['usuario_id']);

        if ($pacientes) {
            foreach ($pacientes as $paciente) {
                echo "<h2>{$paciente['nombre']} {$paciente['apellidos']} (ID del paciente: {$paciente['paciente_id']})</h2>";
                echo "<br>";    

                // Crear una instancia de la clase Medicamento y obtener medicamentos para el paciente actual
                $medicamentoModel = new Medicamento();
                $medicamentos = $medicamentoModel->getMedicamentosByPacienteID($paciente['paciente_id']);

                if ($medicamentos) {
                    echo "<ul>";
                    foreach ($medicamentos as $medicamento) {
                        echo "<li>Nombre del medicamento: {$medicamento['nombre_medicamento']}, (ID del medicamento: {$medicamento['medicamento_id']})</li>";
                        echo "<br>";    

                    }
                    echo "</ul>";
                } else {
                    echo "<p>No se encontraron medicamentos para este paciente.</p>";
                }
            }
        } else {
            echo "<p>No se encontraron pacientes registrados.</p>";
        }

        ?>
        <a href="success.php" class="btn">Volver</a>
    </div>
</body>
</html>
