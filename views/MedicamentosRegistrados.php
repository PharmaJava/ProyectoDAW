<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos Registrados</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <!-- Agregar DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
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

        // Obtener el nombre de usuario de la sesión
        $nombre_usuario = $_SESSION['username'];
        echo "<br>";
        echo "<h1>Medicamentos Registrados por {$nombre_usuario}</h1>";
        echo "<br><br><br><br><br>";
        // Crear una instancia de la clase Paciente
        $pacienteModel = new Paciente();
        $pacientes = $pacienteModel->getPacientesByUsuarioId($_SESSION['usuario_id']);

        if ($pacientes) {
            echo "<table id='medicamentosTable'>"; // Agregar un ID a la tabla para DataTables
            echo "<thead>";
            echo "<tr><th>Paciente </th><th>Medicamento           |</th><th>ID_Medicamento|</th><th>Acciones</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($pacientes as $paciente) {
                // Crear una instancia de la clase Medicamento y obtener medicamentos para el paciente actual
                $medicamentoModel = new Medicamento();
                $medicamentos = $medicamentoModel->getMedicamentosByPacienteID($paciente['paciente_id']);

                if ($medicamentos) {
                    foreach ($medicamentos as $medicamento) {
                        echo "<tr>";
                        echo "<td>{$paciente['nombre']} {$paciente['apellidos']} (ID: {$paciente['paciente_id']})</td>";
                        echo "<td>{$medicamento['nombre_medicamento']}</td>";
                        echo "<td>{$medicamento['medicamento_id']}</td>";
                        echo "<td>";
                        // Formulario para modificar el medicamento
                        echo "<form action='modificar_medicamento.php' method='post'>";
                        echo "<input type='hidden' name='medicamento_id' value='{$medicamento['medicamento_id']}'>";
                        echo "<button type='submit' class='btn btn-modificar'>Modificar</button>";
                        echo "</form>";
                        // Formulario para borrar el medicamento
                        echo "<form action='borrar_medicamento.php' method='post'>";
                        echo "<input type='hidden' name='medicamento_id' value='{$medicamento['medicamento_id']}'>";
                        echo "<button type='submit' class='btn btn-eliminar'>Borrar</button>"; // Agregar una clase para el botón de eliminar
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron medicamentos para el paciente {$paciente['nombre']} {$paciente['apellidos']}</td></tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No se encontraron pacientes registrados.</p>";
        }
        echo "<br>";
        ?>
        <a href="success.php" class="btn">Volver</a>
    </div>
    <!-- Agregar jQuery y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="../admin/script.js"></script> <!-- Ruta al archivo JavaScript -->
</body>
</html>
