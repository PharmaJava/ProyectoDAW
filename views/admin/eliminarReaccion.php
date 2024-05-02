<?php
require_once __DIR__ . '/../../models/Reacciones.php'; // Ajusta la ruta según tu estructura de archivos

session_start(); // Iniciar sesión

if (!isset($_SESSION['usuario_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header('Location: index.php');
    exit();
}

// Verificar si se ha enviado un ID de reacción para eliminar
if (isset($_POST['reaccion_id'])) {
    // Crear una instancia del modelo Reacciones
    $reaccion = new Reacciones();

    // Obtener el ID de la reacción a eliminar desde el formulario
    $reaccion_id = $_POST['reaccion_id'];

    // Intentar eliminar la reacción
    $resultado = $reaccion->eliminarReaccion($reaccion_id);

    if ($resultado) {
        // Redirigir a una página de éxito
        header("Location: AdminReacciones.php");
        exit();
    } else {
        // Mostrar un mensaje de error si falla la eliminación
        echo "<p>Error al eliminar la reacción. Por favor, intenta nuevamente.</p>";
    }
} else {
    // Si no se ha proporcionado un ID de reacción válido, redirigir a la página de administración de reacciones
    header("Location: AdminReacciones.php");
    exit();
}
?>
