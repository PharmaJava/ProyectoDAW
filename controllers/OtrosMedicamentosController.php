<?php
require_once '../models/OtrosMedicamentos.php'; // Asegúrate de que el path al modelo es correcto.
require_once '../config/db.php';

session_start();

class OtrosMedicamentosController {

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            // Crear una nueva instancia de OtrosMedicamentos
            $otrosMedicamentos = new OtrosMedicamentos();

            // Asignar los valores recibidos del formulario a las propiedades del modelo
            $otrosMedicamentos->setPacienteId($_POST['paciente_id']);
            $otrosMedicamentos->setNombreMedicamento($_POST['nombre_medicamento']);
            $otrosMedicamentos->setPosologia($_POST['posologia']);
            $otrosMedicamentos->setFechaInicio($_POST['fecha_inicio']);
            $otrosMedicamentos->setFechaFin($_POST['fecha_fin']);
            $otrosMedicamentos->setUsoMedicacion($_POST['uso_medicacion']);

            // Guardar el registro en la base de datos
            $result = $otrosMedicamentos->save();

            if ($result) {
                $this->redirectByRole();
            } else {
                // Redireccionar a la página de error o mostrar un mensaje
                header('Location: ../views/OtrosMedicamentos.php'); // Redirigir a la página de formulario si hay un error
                exit();
            }
        } else {
            // Redireccionar o mostrar error si el método no es POST o si no se envían datos
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

// Instanciar y llamar al método 'save' si se solicita
if (isset($_POST['submit'])) {
    $controller = new OtrosMedicamentosController();
    $controller->save();
}
?>
