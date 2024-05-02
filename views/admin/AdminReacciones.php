<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Reacciones</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Reacciones adversas de los medicamentos</h1>
    <?php
    require_once __DIR__ . '/../../models/reacciones.php';
    $reaccion = new Reacciones(); // Utiliza el nombre de clase correcto
    $reacciones = $reaccion->getReacciones();

    if (!empty($reacciones)) {
        echo "<table id='reaccionesTable'>";
        echo "<thead>";
        echo "<tr><th>Paciente</th><th>Medicamento</th><th>Síntoma</th><th>Fecha de Inicio</th><th>Fecha de Fin</th><th>Estado Actual</th><th>Otros Datos de Interés</th><th>Acciones</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($reacciones as $reaccion) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($reaccion['nombre_paciente'])."</td>";
            echo "<td>".htmlspecialchars($reaccion['nombre_medicamento'])."</td>";
            echo "<td>".htmlspecialchars($reaccion['sintoma'])."</td>";
            echo "<td>".htmlspecialchars($reaccion['fecha_inicio'])."</td>";
            echo "<td>".htmlspecialchars($reaccion['fecha_fin'])."</td>";
            echo "<td>".htmlspecialchars($reaccion['estado_actual'])."</td>";
            echo "<td>".htmlspecialchars($reaccion['otros_datos_interes'])."</td>";
            echo "<td>";
            echo "<form action='modificarReaccion.php' method='POST' style='display: inline;'>";
            echo "<input type='hidden' name='reaccion_id' value='".$reaccion['id']."'>";
            echo "<button type='submit' name='modificar'>Modificar</button>";
            echo "</form> ";
            echo "<form action='eliminarReaccion.php' method='POST' style='display: inline;' onsubmit='return confirm(\"¿Está seguro de querer eliminar esta reacción?\");'>";
            echo "<input type='hidden' name='reaccion_id' value='".$reaccion['id']."'>";
            echo "<button type='submit' name='eliminar'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay reacciones adversas registradas.</p>";
    }
    ?>
    <a href="AdminDashboard.php" class="btn">Volver al Dashboard</a>
</div>

<script>
$(document).ready(function() {
    $('#reaccionesTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
});
</script>

</body>
</html>
