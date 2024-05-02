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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    // Intentar eliminar el medicamento
    $id = $_POST['id'];

    $resultado = $otrosmedicamento->eliminarMedicamento($id);

    if ($resultado) {
        echo "<p>Medicamento eliminado correctamente.</p>";
    } else {
        echo "<p>Error al eliminar el medicamento.</p>";
    }
}

// Redireccionar a la página anterior
header("Location: AdminOtrosMedicamentos.php");
exit();
?>
