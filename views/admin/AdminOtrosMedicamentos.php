<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Otros Medicamentos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Otros Medicamentos</h1>
    <?php
    require_once __DIR__ . '/../../models/otrosmedicamentos.php';
    $otrosmedicamento = new otrosMedicamentos();
    $otros_medicamentos = $otrosmedicamento->getAllMedicamentos();

    if (!empty($otros_medicamentos)) {
        echo "<table id='medicamentosTable'>";
        echo "<thead>";
        echo "<tr><th>Nombre del Medicamento</th><th>Paciente</th><th>Acciones</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($otros_medicamentos as $otro_medicamento) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($otro_medicamento['nombre_medicamento'])."</td>";
            echo "<td>".htmlspecialchars($otro_medicamento['id'])."</td>";
            echo "<td>";
            echo "<form action='modificarOtrosMedicamentos.php' method='POST' class='form-inline' style='display: inline;'>";
            echo "<input type='hidden' name='id' value='".$otro_medicamento['id']."'>";
            echo "<button type='submit' name='modificar' class='btn btn-modificar'>Modificar</button>";
            echo "</form> ";
            echo "<form action='eliminarOtrosMedicamentos.php' method='POST' class='form-inline' style='display: inline;' onsubmit='return confirm(\"¿Está seguro de querer eliminar este medicamento?\");'>";
            echo "<input type='hidden' name='id' value='".$otro_medicamento['id']."'>"; // Asegurarse de enviar el ID correcto
            echo "<button type='submit' name='eliminar'class='btn btn-borrar'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay medicamentos registrados.</p>";
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
