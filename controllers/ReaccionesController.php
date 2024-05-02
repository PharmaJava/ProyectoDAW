<?php
require_once '../models/Reacciones.php';

session_start();  // Asegúrate de iniciar la sesión al principio del script

class ReaccionesController {

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $reaccion = new Reacciones();

            // Asignar valores desde el formulario a las propiedades del objeto Reacciones
            $reaccion->setPacienteId($_POST['paciente_id']);
            $reaccion->setMedicamentoId($_POST['medicamento_id']);
            $reaccion->setSintoma($_POST['sintoma']);
            $reaccion->setFechaInicio($_POST['fecha_inicio']);
            $reaccion->setFechaFin($_POST['fecha_fin']);
            $reaccion->setEstadoActual($_POST['estado_actual']);
            $reaccion->setOtrosDatosInteres($_POST['otros_datos']);

            $result = $reaccion->save();

            if ($result) {
                $this->redirectByRole();
            } else {
                header('Location: ../views/error.php');
                exit();
            }
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            exit("Método no permitido o datos no enviados");
        }
    }

    private function redirectByRole() {
        // Asumimos que el rol del usuario está almacenado en la sesión
        $role = $_SESSION['rol'] ?? 'guest';  // Usar 'guest' como valor por defecto si no está definido

        switch ($role) {
            case 'admin':
                header('Location: ../views/admin/AdminDashboard.php');
                break;
            case 'paciente':
                header('Location: ../views/paciente/Pacientesuccess.php');
                break;
            case 'sanitario':
                header('Location: ../views/success.php');
                break;
            default:
                header('Location: ../views/index.php'); // Página de inicio por defecto o página de login
                break;
        }
        exit();
    }

}

if (isset($_POST['submit'])) {
    $controller = new ReaccionesController();
    $controller->save();
}
?>
