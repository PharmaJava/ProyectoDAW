<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Reacción</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body>
<div class="full-page-form">
    <?php
    require_once __DIR__ . '/../../models/reacciones.php';

    session_start(); // Iniciar sesión

    if (!isset($_SESSION['usuario_id'])) {
        // Si no está autenticado, redirigir al inicio de sesión
        header('Location: index.php');
        exit();
    }

    $reaccion = new Reacciones();

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Intento de actualizar la reacción
        $reaccion_id = $_POST['reaccion_id'];
        $sintoma = $_POST['sintoma'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $estado_actual = $_POST['estado_actual'];
        $otros_datos_interes = $_POST['otros_datos_interes'];

        $resultado = $reaccion->actualizarReaccion($reaccion_id, $sintoma, $fecha_inicio, $fecha_fin, $estado_actual, $otros_datos_interes);

        if ($resultado) {
            echo "<p>Reacción actualizada correctamente.</p>";
            header("Location: AdminReacciones.php");
        } else {
            echo "<p>Error al actualizar los datos de la reacción.</p>";
            header("Location: modificarReaccion.php");
        }
    } else if (isset($_POST['reaccion_id'])) {
        // Mostrar el formulario con los datos actuales de la reacción
        $reaccion_info = $reaccion->getReaccionById($_POST['reaccion_id']);

        if ($reaccion_info) {
            ?>
            <h2>Modificar Reacción</h2>
            <p>Modificando reacción ID: <?php echo $reaccion_info['id']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="reaccion_id" value="<?php echo $reaccion_info['id']; ?>">
                <div class="form-group">
                    <label for="sintoma">Síntoma:</label>
                    <input type="text" id="sintoma" name="sintoma" value="<?php echo $reaccion_info['sintoma']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $reaccion_info['fecha_inicio']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $reaccion_info['fecha_fin']; ?>">
                </div>
                <div class="form-group">
                    <label for="estado_actual">Estado Actual:</label>
                    <select id="estado_actual" name="estado_actual">
                        <option value="resuelto" <?php echo $reaccion_info['estado_actual'] === 'resuelto' ? 'selected' : ''; ?>>Resuelto</option>
                        <option value="pendiente" <?php echo $reaccion_info['estado_actual'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="en tratamiento" <?php echo $reaccion_info['estado_actual'] === 'en tratamiento' ? 'selected' : ''; ?>>En Tratamiento</option>
                        <option value="otro" <?php echo $reaccion_info['estado_actual'] === 'otro' ? 'selected' : ''; ?>>Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="otros_datos_interes">Otros Datos de Interés:</label>
                    <textarea id="otros_datos_interes" name="otros_datos_interes"><?php echo $reaccion_info['otros_datos_interes']; ?></textarea>
                </div>
                <button type="submit" name="submit"class='btn btn-modificar'>Modificar</button>
            </form>
            <a href="AdminReacciones.php" class="btn">Volver</a>
            <?php
        } else {
            echo "<p>No se encontraron datos de la reacción. Asegúrese de que el ID es correcto.</p>";
        }
    } else {
        echo "<p>No se ha proporcionado un ID de reacción válido.</p>";
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="script.js"></script>
</body>
</html>
