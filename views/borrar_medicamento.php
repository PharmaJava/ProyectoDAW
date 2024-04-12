<?php
require_once __DIR__ . '/../config/db.php'; // Asegúrate de que el path está correcto
require_once '../models/Medicamento.php';

session_start();

// Comprobar si el usuario está autenticado y si el método es POST
if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si no está autenticado o el método no es POST, redirigir al inicio de sesión
    header('Location: index.php');
    exit();
}

// Asegurarte de que el medicamento_id está presente en el POST
if (isset($_POST['medicamento_id']) && is_numeric($_POST['medicamento_id'])) {
    $medicamento_id = $_POST['medicamento_id'];
    $medicamentoModel = new Medicamento();

    // Llamar a la función de eliminación del modelo
    if ($medicamentoModel->borrarMedicamento($medicamento_id)) {
        // Si el medicamento se elimina correctamente, redirigir a una página de éxito
        header('Location: success.php');
    } else {
        // Si hay un problema al eliminar, redirigir a una página de error
        header('Location: error.php');
    }
} else {
    // Si el medicamento_id no es válido, redirigir a una página de error
    header('Location: error.php');
}

?>
