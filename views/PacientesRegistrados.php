<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Registrados</title>
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

        // Obtener el usuario_id de la sesión
        $usuario_id = $_SESSION['usuario_id'];

        // Crear una instancia de la clase Paciente y obtener los pacientes registrados por el usuario
        $paciente = new Paciente();
        $pacientes = $paciente->getPacientesByUsuarioId($usuario_id);

        // Contar el número de pacientes registrados
        $num_registros = count($pacientes);

        // Verificar si se encontraron pacientes
        if ($pacientes) {
            // Mostrar la lista de pacientes
            echo "<br>";
            echo "<h2>Pacientes Registrados</h2>";
            echo "<br>";
            echo "<br>";
            echo "<p>Tiene un número de registros igual a: $num_registros</p>";
            echo "<br>";
            echo "<ul>";
            foreach ($pacientes as $paciente) {
                echo "<li>{$paciente['nombre']} {$paciente['apellidos']} (Paciente número: {$paciente['paciente_id']})";
        
                // Formulario para modificar o borrar el paciente
                echo "<form action=\"PacienteModificar.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"paciente_id\" value=\"{$paciente['paciente_id']}\">";
                echo "<button type=\"submit\" class=\"btn-modificar\">Modificar</button>";
        
                // Botón para borrar el paciente
                echo "<button type=\"submit\" formaction=\"borrar_paciente.php\" formmethod=\"post\" class=\"btn\">Borrar</button>";
        
                echo "</form>";
        
                echo "</li>";
                echo "<br>";
            }
            echo "</ul>";
        } else {
            // Mostrar un mensaje si no se encontraron pacientes
            echo "<p>No hay pacientes registrados.</p>";
        }
        ?>
        <a href="success.php" class="btn">Volver</a>
    </div>
</body>
</html>
