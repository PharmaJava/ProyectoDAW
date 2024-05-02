<?php
require_once '../models/Medicamento.php';

session_start(); // Asegúrate de que la sesión siempre se inicia al principio del script

class MedicamentoController {

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $medicamento = new Medicamento();

            // Asignar valores desde el formulario a las propiedades del objeto Medicamento
            $medicamento->setNombreMedicamento($_POST['nombre_medicamento']);
            $medicamento->setFechaInicio($_POST['fecha_inicio']);
            $medicamento->setFechaFin($_POST['fecha_fin']);
            $medicamento->setUso($_POST['uso']);
            $medicamento->setCodigoNacional($_POST['codigo_nacional']);
            $medicamento->setLote($_POST['lote']);
            $medicamento->setFechaCaducidad($_POST['fecha_caducidad']);
            $medicamento->setPosologia($_POST['posologia']);
            $medicamento->setViaAdministracion($_POST['via_administracion']);
            $medicamento->setPacienteId($_POST['paciente_id']);

            $result = $medicamento->save();

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
                header('Location: ../views/paciente/pacientesuccess.php');
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
    $controller = new MedicamentoController();
    $controller->save();
}
?>
