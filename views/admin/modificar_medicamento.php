<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Medicamento</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php
        require_once __DIR__ . '/../../config/db.php';
        require_once __DIR__ . '/../../models/Usuario.php';

        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php');
            exit();
        }

        // Obtener el ID del medicamento desde la URL o de un formulario POST
        $medicamento_id = isset($_GET['medicamento_id']) ? $_GET['medicamento_id'] : (isset($_POST['medicamento_id']) ? $_POST['medicamento_id'] : null);

        if (!$medicamento_id) {
            echo "<p>Error: No se especificó un medicamento.</p>";
            exit;
        }

        $medicamentoModel = new Medicamento();
        $medicamento = $medicamentoModel->getPacienteById($medicamento_id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            // Aquí procesarías los datos enviados por el formulario
            $nombre_medicamento = $_POST['nombre_medicamento'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $uso = $_POST['uso'];

            //actualizamos el medicamento
            $actualizado = $medicamentoModel->actualizarMedicamento($medicamento_id, $nombre_medicamento, $fecha_inicio, $fecha_fin, $uso);
            if ($actualizado) {
                echo "<p>Medicamento actualizado con éxito.</p>";
                header('Refresh: 2; URL = AdminDashboard.php');
            } else {
                echo "<p>Error al actualizar el medicamento.</p>";
            }
        } else {
            // Mostrar el formulario con los datos existentes del medicamento
            if ($medicamento) {
                ?>
                <h1>Modificar Medicamento</h1>
                <form action="modificar_medicamento.php" method="post">
                    <input type="hidden" name="medicamento_id" value="<?php echo $medicamento_id; ?>">
                    <label for="nombre_medicamento">Nombre del Medicamento:</label>
                    <input type="text" id="nombre_medicamento" name="nombre_medicamento" value="<?php echo htmlspecialchars($medicamento['nombre_medicamento']); ?>" required>

                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $medicamento['fecha_inicio']; ?>">

                    <label for="fecha_fin">Fecha de Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $medicamento['fecha_fin']; ?>">

                    <label for="uso">Uso:</label>
                    <input type="text" id="uso" name="uso" value="<?php echo htmlspecialchars($medicamento['uso']); ?>">

                    <button type="submit" name="update" class="btn">Actualizar Medicamento</button>
                </form>
                <?php
            } else {
                echo "<p>Medicamento no encontrado.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
