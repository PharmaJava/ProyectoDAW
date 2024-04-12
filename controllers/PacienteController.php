<?php
require_once '../config/db.php';
require_once '../models/Paciente.php';

session_start();

class PacienteController {
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
            $paciente = new Paciente();
            $paciente->setUsuario_id($_SESSION['usuario_id']);
            $paciente->setNombre($_POST['nombre']);
            $paciente->setApellidos($_POST['apellidos']);
            $paciente->setSexo($_POST['sexo']);
            $paciente->setEdad($_POST['edad']);
            $paciente->setPeso($_POST['peso']);
            $paciente->setAltura($_POST['altura']);
            $paciente->setPaciente_id($_POST['paciente_id']);

            $result = $paciente->save();

            // Comprobación del rol del usuario para decidir la redirección adecuada
            if ($result) {
                if ($_SESSION['rol'] === 'admin') {
                    header('Location: ../views/admin/AdminDashboard.php'); // Redirige a los admins al dashboard de admin
                    exit();
                } else {
                    header('Location: ../views/success.php'); // Redirige a usuarios no admins a la página de éxito
                    exit();
                }
            } else {
                $_SESSION['error_registro'] = "Hubo un error al registrar el paciente.";
                header('Location: ../views/paciente.php');
                exit();
            }
        } else {
            header('Location: ../views/paciente.php');
            exit();
        }
    }
}

if (isset($_POST['submit'])) {
    $controller = new PacienteController();
    $controller->save();
}
?>
