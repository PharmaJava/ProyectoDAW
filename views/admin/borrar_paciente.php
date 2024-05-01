<?php
// Verificar si se ha enviado el formulario de borrado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["paciente_id"])) {
    // Incluir el archivo de configuración de la base de datos
    require_once '..\..\config\db.php';
    require_once '../paciente/modelspaciente.php';

    // Obtener el id del paciente a borrar
    $paciente_id = $_POST["paciente_id"];

    // Crear una instancia de la clase Paciente
    $paciente = new Paciente();

    // Intentar borrar el paciente de la base de datos
    $result = $paciente->borrarPaciente($paciente_id);

    // Verificar si el paciente se borró correctamente
    if ($result) {
        // Redirigir a la página de éxito
        header("Location: AdminPacientes.php");
        exit();
    } else {
        // Mostrar un mensaje de error
        echo "Error al borrar el paciente.";
    }
} else {
    // Redirigir si no se recibió un id de paciente válido
    header("Location: PacientesRegistrados.php");
    exit();
}
