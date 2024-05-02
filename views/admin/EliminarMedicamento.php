<?php
require_once '../../models/medicamento.php';

session_start(); // Iniciar sesión

if (!isset($_SESSION['usuario_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header('Location: index.php');
    exit();
}

// Verificar si se recibió un ID de medicamento para borrar
if(isset($_POST['medicamento_id']) && !empty($_POST['medicamento_id'])){
    $medicamento_id = $_POST['medicamento_id'];
    
    // Crear una instancia de la clase Medicamento
    $medicamento = new Medicamento();

    // Eliminar las reacciones asociadas al medicamento
    $resultado_reacciones = $medicamento->borrarReaccionesDelMedicamento($medicamento_id);

    if($resultado_reacciones){
        // Borrar el medicamento después de eliminar las reacciones
        $resultado_medicamento = $medicamento->borrarMedicamento($medicamento_id);

        if($resultado_medicamento){
            // Redireccionar al administrador de medicamentos con un mensaje de éxito
            $_SESSION['success_message'] = "Medicamento eliminado correctamente.";
            header("Location: AdminMedicamentos.php");
            exit();
        } else {
            // Redireccionar al administrador de medicamentos con un mensaje de error
            $_SESSION['error_message'] = "Error al intentar eliminar el medicamento.";
            header("Location: AdminMedicamentos.php");
            exit();
        }
    } else {
        // Redireccionar al administrador de medicamentos con un mensaje de error
        $_SESSION['error_message'] = "Error al intentar eliminar las reacciones del medicamento.";
        header("Location: AdminMedicamentos.php");
        exit();
    }
} else {
    // Si no se proporcionó un ID de medicamento válido, redireccionar con un mensaje de error
    $_SESSION['error_message'] = "No se proporcionó un ID de medicamento válido.";
    header("Location: AdminMedicamentos.php");
    exit();
}
?>
