<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Medicamentos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Medicamentos que causaron reacciones adversas</h1>
    <?php
    require_once __DIR__ . '/../../models/medicamento.php';
    $medicamento = new Medicamento();
    $medicamentos = $medicamento->getMedicamentosConReacciones();

    if (!empty($medicamentos)) {
        echo "<table id='medicamentosTable'>";
        echo "<thead>";
        echo "<tr><th>Nombre del Medicamento</th><th>Paciente</th><th>ID Paciente</th><th>Acciones</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($medicamentos as $med) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($med['nombre_medicamento'])."</td>";
            echo "<td>".htmlspecialchars($med['nombre_paciente'])."</td>";
            echo "<td>".htmlspecialchars($med['paciente_id'])."</td>";
            echo "<td>";
            echo "<form action='modificarMedicamento.php' method='POST' style='display: inline;'>";
            echo "<input type='hidden' name='medicamento_id' value='".$med['medicamento_id']."'>";
            echo "<button type='submit' name='modificar'>Modificar</button>";
            echo "</form> ";
            echo "<form action='eliminarMedicamento.php' method='POST' style='display: inline;' onsubmit='return confirm(\"¿Está seguro de querer eliminar este medicamento?\");'>";
            echo "<input type='hidden' name='medicamento_id' value='".$med['medicamento_id']."'>";
            echo "<button type='submit' name='eliminar'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay medicamentos que hayan causado reacciones adversas registradas.</p>";
    }
    ?>
    <a href="AdminDashboard.php" class="btn">Volver al Dashboard</a>
</div>

<script>
$(document).ready(function() {
    $('#medicamentosTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});
</script>

</body>
</html>
