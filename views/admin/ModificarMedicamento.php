<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Medicamento</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body>
<div class="full-page-form">
    <?php
  
  require_once __DIR__ . '/../../models/medicamento.php';

    session_start(); // Iniciar sesión

    if (!isset($_SESSION['usuario_id'])) {
        // Si no está autenticado, redirigir al inicio de sesión
        header('Location: index.php');
        exit();
    }

    $medicamento = new Medicamento();

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Intento de actualizar el medicamento
        $medicamento_id = $_POST['medicamento_id'];
        $nombre_medicamento = $_POST['nombre_medicamento'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $uso = $_POST['uso'];
        $codigo_nacional = $_POST['codigo_nacional'];
        $lote = $_POST['lote'];
        $fecha_caducidad = $_POST['fecha_caducidad'];
        $posologia = $_POST['posologia'];
        $via_administracion = $_POST['via_administracion'];

        $resultado = $medicamento->actualizarMedicamento($medicamento_id, $nombre_medicamento, $fecha_inicio, $fecha_fin, $uso, $codigo_nacional, $lote, $fecha_caducidad, $posologia, $via_administracion);

        if ($resultado) {
            echo "<p>Medicamento actualizado correctamente.</p>";
            header("Location: AdminMedicamentos.php");
        } else {
            echo "<p>Error al actualizar los datos del medicamento.</p>";
            header("Location: ModificarMedicamento.php");
        }
    } else if (isset($_POST['medicamento_id'])) {
        // Mostrar el formulario con los datos actuales del medicamento
        $medicamento_info = $medicamento->getMedicamentoById($_POST['medicamento_id']);

        if ($medicamento_info) {
            ?>
            <h2>Modificar Medicamento</h2>
            <p>Modificando medicamento ID: <?php echo $medicamento_info['medicamento_id']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="medicamento_id" value="<?php echo $medicamento_info['medicamento_id']; ?>">
                <div class="form-group">
                    <label for="nombre_medicamento">Nombre del Medicamento:</label>
                    <input type="text" id="nombre_medicamento" name="nombre_medicamento" value="<?php echo $medicamento_info['nombre_medicamento']; ?>" required>
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
                    <label for="uso">Uso:</label>
                    <input type="text" id="uso" name="uso" value="<?php echo $medicamento_info['uso']; ?>">
                </div>
                <div class="form-group">
                    <label for="codigo_nacional">Código Nacional:</label>
                    <input type="text" id="codigo_nacional" name="codigo_nacional" value="<?php echo $medicamento_info['codigo_nacional']; ?>">
                </div>
                <div class="form-group">
                    <label for="lote">Lote:</label>
                    <input type="text" id="lote" name="lote" value="<?php echo $medicamento_info['lote']; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha_caducidad">Fecha de Caducidad:</label>
                    <input type="date" id="fecha_caducidad" name="fecha_caducidad" value="<?php echo $medicamento_info['fecha_caducidad']; ?>">
                </div>
                <div class="form-group">
                    <label for="posologia">Posología:</label>
                    <textarea id="posologia" name="posologia"><?php echo $medicamento_info['posologia']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="via_administracion">Vía de Administración:</label>
                    <select id="via_administracion" name="via_administracion">
                        <option value="oral" <?php echo $medicamento_info['via_administracion'] === 'oral' ? 'selected' : ''; ?>>Oral</option>
                        <option value="parenteral" <?php echo $medicamento_info['via_administracion'] === 'parenteral' ? 'selected' : ''; ?>>Parenteral</option>
                        <option value="topica" <?php echo $medicamento_info['via_administracion'] === 'topica' ? 'selected' : ''; ?>>Tópica</option>
                        <option value="otra" <?php echo $medicamento_info['via_administracion'] === 'otra' ? 'selected' : ''; ?>>Otra</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn">Modificar</button>
            </form>
            <a href="AdminMedicamentos.php" class="btn">Volver</a>
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
