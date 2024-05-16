<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Otros Medicamentos</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body>
<div class="full-page-form">
    <?php
    require_once __DIR__ . '/../../models/otrosmedicamentos.php';

    session_start(); // Iniciar sesión

    if (!isset($_SESSION['usuario_id'])) {
        // Si no está autenticado, redirigir al inicio de sesión
        header('Location: index.php');
        exit();
    }

    $otrosmedicamento = new OtrosMedicamentos();

    // Verificar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Intento de actualizar el medicamento
        $id = $_POST['id'];
        $nombre_medicamento = $_POST['nombre_medicamento'];
        $posologia = $_POST['posologia'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $uso_medicacion = $_POST['uso_medicacion'];

        $resultado = $otrosmedicamento->actualizarMedicamento($id, $nombre_medicamento, $posologia, $fecha_inicio, $fecha_fin, $uso_medicacion);

        if ($resultado) {
            echo "<p>Medicamento actualizado correctamente.</p>";
            header("Location: AdminOtrosMedicamentos.php");
        } else {
            echo "<p>Error al actualizar los datos del medicamento.</p>";
            header("Location: modificarOtrosMedicamentos.php");
        }
    } else if (isset($_POST['id'])) {
        // Mostrar el formulario con los datos actuales del medicamento
        $medicamento_info = $otrosmedicamento->getMedicamentoById($_POST['id']);

        if ($medicamento_info) {
            ?>
            <h2>Modificar Otros Medicamentos</h2>
            <p>Modificando medicamento ID: <?php echo $medicamento_info['id']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $medicamento_info['id']; ?>">
                <div class="form-group">
                    <label for="nombre_medicamento">Nombre del Medicamento:</label>
                    <input type="text" id="nombre_medicamento" name="nombre_medicamento" value="<?php echo $medicamento_info['nombre_medicamento']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="posologia">Posología:</label>
                    <textarea id="posologia" name="posologia"><?php echo $medicamento_info['posologia']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $medicamento_info['fecha_inicio']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $medicamento_info['fecha_fin']; ?>">
                </div>
                <div class="form-group">
                    <label for="uso_medicacion">Uso de la medicación:</label>
                    <input type="text" id="uso_medicacion" name="uso_medicacion" value="<?php echo $medicamento_info['uso_medicacion']; ?>">
                </div>
                <button type="submit" name="submit" class='btn btn-modificar'>Modificar</button>
            </form>
            <a href="AdminOtrosMedicamentos.php" class="btn">Volver</a>
            <?php
        } else {
            echo "<p>No se encontraron datos del medicamento. Asegúrese de que el ID es correcto.</p>";
        }
    } else {
        echo "<p>No se ha proporcionado un ID de medicamento válido.</p>";
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="script.js"></script>
</body>
</html>
