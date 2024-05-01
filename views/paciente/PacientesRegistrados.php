<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Registrados</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <!-- Agregar CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <?php
        require_once __DIR__ . '/../../config/db.php';
        require_once 'modelspaciente.php';

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            // Si el usuario no está autenticado, redirige al inicio de sesión
            header('Location: index.php');
            exit();
        }

        // Obtener el usuario_id de la sesión
        $usuario_id = $_SESSION['usuario_id'];

        // Crear una instancia de la clase Paciente y obtener los pacientes registrados por el usuario
        $paciente = new Paciente();
        $pacientes = $paciente->getPacientesByUsuarioId($usuario_id);

        // Contar el número de pacientes registrados
        $num_registros = count($pacientes);

        // Verificar si se encontraron pacientes
        if ($pacientes) {
            // Mostrar la lista de pacientes en una tabla
            echo "<h2>Pacientes Registrados</h2>";
            echo "<br>";
            echo "<p>Tiene un número de registros igual a: $num_registros</p>";
            echo "<br>";
            echo "<table id='pacientesTable'>"; // Agregar un ID a la tabla para DataTables
            echo "<thead>";
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>ID</th><th>Acciones</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($pacientes as $paciente) {
                echo "<tr>";
                echo "<td>{$paciente['nombre']}</td>";
                echo "<td>{$paciente['apellidos']}</td>";
                echo "<td>{$paciente['paciente_id']}</td>";
                echo "<td>";
                echo "<form action=\"PacienteModificar.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"paciente_id\" value=\"{$paciente['paciente_id']}\">";
                echo "<button type=\"submit\" class=\"btn-modificar\">Modificar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            // Mostrar un mensaje si no se encontraron pacientes
            echo "<p>No hay pacientes registrados.</p>";
        }
        echo "<br>";
        ?>
        <a href="pacientesuccess.php" class="btn">Volver</a>
    </div>
    <!-- Agregar jQuery y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        // Activar DataTables en la tabla con el ID 'pacientesTable'
        $(document).ready(function() {
            $('#pacientesTable').DataTable();
        });
    </script>
</body>
</html>
