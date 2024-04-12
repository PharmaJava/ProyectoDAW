<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Pacientes</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Administrar Pacientes</h1>
        <?php
        require_once '../../config/db.php';
        require_once '../../models/paciente.php';
        session_start();
        if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php'); // Redirige si el usuario no es administrador
            exit();
        }

        $pacienteModel = new Paciente();
        $pacientes = $pacienteModel->all(); // Método que devuelve todos los pacientes

        if ($pacientes) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Acciones</th></tr>";
            foreach ($pacientes as $paciente) {
                echo "<tr>";
                echo "<td>{$paciente->getPaciente_id()}</td>";
                echo "<td>{$paciente->getNombre()}</td>";
                echo "<td>{$paciente->getApellidos()}</td>";
                echo "<td>";
                echo "<a href='editarPaciente.php?paciente_id={$paciente->getPaciente_id()}' class='button'>Editar</a> "; // Editar paciente
                echo "<a href='eliminarPaciente.php?paciente_id={$paciente->getPaciente_id()}' class='button'>Eliminar</a>"; // Eliminar paciente
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay pacientes registrados.</p>";
        }
        ?>
        <a href="AdminDashboard.php" class="button">Volver al Dashboard</a>
    </div>
</body>
</html>
