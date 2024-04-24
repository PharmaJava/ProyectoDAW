<?php
require_once '../../config/db.php';
require_once 'modelspaciente.php';

session_start();

class PacienteController {
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
            $paciente = new Paciente();

        
            // Configurar los datos del nuevo paciente
            $paciente->setUsuario_id($_SESSION['usuario_id']);
            $paciente->setNombre($_POST['nombre']);
            $paciente->setApellidos($_POST['apellidos']);
            $paciente->setSexo($_POST['sexo']);
            $paciente->setEdad($_POST['edad']);
            $paciente->setPeso($_POST['peso']);
            $paciente->setAltura($_POST['altura']);

            // Guardar el registro del paciente
            $result = $paciente->save();

            if ($result) {
                // Redirigir al éxito
                header("Location: pacientesuccess.php");
                exit();
            } else {
                // Registrar error y redirigir de nuevo al formulario
                $_SESSION['error_registro'] = "Hubo un error al registrar el paciente.";
                header('Location: paciente.php');
                exit();
            }
        } else {
            // Redirigir al formulario si no hay datos de POST o no está establecido el usuario_id
            header('Location: paciente.php');
            exit();
        }
    }
}

// Verificar si el botón de submit fue presionado y procesar el guardado
if (isset($_POST['submit'])) {
    $controller = new PacienteController();
    $controller->save();
}
?>
