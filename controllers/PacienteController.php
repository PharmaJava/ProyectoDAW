<?php
require_once '../models/Paciente.php';

session_start();

class PacienteController {
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && isset($_SESSION['usuario_id'])) {
            $paciente = new Paciente();
            $paciente->setUsuario_id($_SESSION['usuario_id']);
            $paciente->setNombre(htmlspecialchars($_POST['nombre']));
            $paciente->setApellidos(htmlspecialchars($_POST['apellidos']));
            $paciente->setSexo(htmlspecialchars($_POST['sexo']));
            $paciente->setEdad(filter_var($_POST['edad'], FILTER_VALIDATE_INT));
            $paciente->setPeso(htmlspecialchars($_POST['peso']));
            $paciente->setAltura(htmlspecialchars($_POST['altura']));

            $paciente_id = $paciente->save();

            if ($paciente_id) {
                $_SESSION['paciente_id'] = $paciente_id;
                session_write_close(); // Guarda los cambios en la sesión antes de redirigir

                $this->redirectByRole(); // Llama a la función de redirección según el rol
            } else {
                $_SESSION['error_registro'] = "Hubo un error al registrar el paciente.";
                header('Location: ../views/paciente/paciente.php');
                exit();
            }
        } else {
            header('Location: ../index.php');
            exit();
        }
    }

    private function redirectByRole() {
        $role = $_SESSION['rol'] ?? 'guest'; // Usa 'guest' como rol por defecto si no está definido
        switch ($role) {
            case 'admin':
                header('Location: ../views/admin/AdminDashboard.php');
                break;
            case 'paciente':
                header("Location: ../views/paciente/pacientesuccess.php");
                break;
            case 'sanitario':
                header("Location: ../views/success.php");
                break;
            default:
                header('Location: ../index.php'); // Redirige a la página de inicio o de login
                break;
        }
        exit();
    }
}

if (isset($_POST['submit'])) {
    $controller = new PacienteController();
    $controller->save();
}
?>
