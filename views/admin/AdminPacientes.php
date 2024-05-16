<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Pacientes</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

</head>
<body>
<div class="container">
    <h1>Administrar Pacientes</h1>
    <?php
    require_once '..\..\config\db.php';
    require_once '../paciente/modelspaciente.php';
    session_start();
    if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
        header('Location: index.php'); // Redirige si el usuario no es administrador
        exit();
    }

    $pacienteModel = new Paciente();
    $pacientes = $pacienteModel->all(); // Método que devuelve todos los pacientes

    if ($pacientes) {
        echo "<table id='pacientesTable'>";
        echo "<thead>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Acciones</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($pacientes as $paciente) {
            echo "<tr>";
            echo "<td>{$paciente->getPaciente_id()}</td>";
            echo "<td>{$paciente->getNombre()}</td>";
            echo "<td>{$paciente->getApellidos()}</td>";
            echo "<td>";
            // Formulario para editar paciente
            echo "<form action='PacienteModificar.php' method='post'  class='form-inline'style='display: inline;'>";
            echo "<input type='hidden' name='paciente_id' value='{$paciente->getPaciente_id()}'>";
            echo "<input type='submit' value='Editar' class='btn btn-modificar'>";
            echo "</form> ";

            // Formulario para eliminar paciente
            echo "<form action='borrar_paciente.php' method='post' class='form-inline' style='display: inline;'>";
            echo "<input type='hidden' name='paciente_id' value='{$paciente->getPaciente_id()}'>";
           // Dentro del bucle PHP para mostrar los pacientes
            echo "<input type='submit' value='Eliminar' class='btn btn-borrar'>";


            echo "</form>";

            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay pacientes registrados.</p>";
    }
    ?>
    <a href="AdminDashboard.php" class="button">Volver al Dashboard</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="script.js"></script>
</body>
</html>
