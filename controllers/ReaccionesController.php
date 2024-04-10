<?php
require_once '../config/db.php';
require_once '../models/reacciones.php';

session_start();
class ReaccionesController {

    // Método para guardar una reacción
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva instancia del modelo Reacciones
            $reaccion = new Reacciones();
            
            // Asignar valores a las propiedades del objeto Reacciones
            $reaccion->setPacienteId($_POST['paciente_id']);
            $reaccion->setMedicamentoId($_POST['medicamento_id']);
            $reaccion->setSintoma($_POST['sintoma']);
            $reaccion->setFechaInicio($_POST['fecha_inicio']);
            $reaccion->setFechaFin($_POST['fecha_fin']);
            $reaccion->setEstadoActual($_POST['estado_actual']);
            $reaccion->setOtrosDatosInteres($_POST['otros_datos_interes']);

            // Intentar guardar la reacción en la base de datos
            $result = $reaccion->save();

            if ($result) {
                // Redireccionar a una página de éxito
                header('Location: ../views/success.php');
            } else {
                // Redireccionar a una página de error o volver al formulario con un mensaje de error
                header('Location: ../views/error.php');
            }
        } else {
            // Si el método no es POST, mostrar un error o redirigir
            header('HTTP/1.1 405 Method Not Allowed');
            exit("Método no permitido");
        }
    }

    // Aquí podrías agregar más métodos relacionados con 'Reacciones'
}

// Verificar si se ha llamado al método 'save' a través de un formulario
if (isset($_POST['submit'])) {
    $controller = new ReaccionesController();
    $controller->save();
}

?>
