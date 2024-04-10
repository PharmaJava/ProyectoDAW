<?php
require_once '../config/db.php';
require_once '../models/Paciente.php';

session_start();

class PacienteController {
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
            $paciente = new Paciente();
            // Asegúrate de que 'usuario_id' está disponible en $_SESSION
            $paciente->setUsuario_id($_SESSION['usuario_id']);
            $paciente->setNombre($_POST['nombre']);
            $paciente->setApellidos($_POST['apellidos']);
            $paciente->setSexo($_POST['sexo']);
            $paciente->setEdad($_POST['edad']);
            $paciente->setPeso($_POST['peso']);
            $paciente->setAltura($_POST['altura']);
            $paciente->setPaciente_id($_POST['paciente_id']);

            $result = $paciente->save();

            if ($result) {
                header('Location: ../views/success.php');
                exit();
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
