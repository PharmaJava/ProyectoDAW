<?php
require_once '../config/db.php';
require_once '../models/Paciente.php'; // Asegúrate de que este archivo exista y tenga la clase Paciente

session_start(); // Inicia sesión al principio del archivo para acceder a $_SESSION

class PacienteController {
    
    public function save() {
        // Verifica que se haya enviado el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crea una nueva instancia del modelo Paciente
            $paciente = new Paciente();
            
            // Asigna los valores del formulario a las propiedades del modelo
        
            $paciente->setUsuario_id($_SESSION['usuario_id']); // Ejemplo de cómo asignar el id de usuario
            $paciente->setNombre($_POST['nombre']);
            $paciente->setApellidos($_POST['apellidos']);
            $paciente->setSexo($_POST['sexo']);
            $paciente->setEdad($_POST['edad']);
            $paciente->setPeso($_POST['peso']);
            $paciente->setAltura($_POST['altura']);
            
            // Intenta guardar el paciente en la base de datos
            $result = $paciente->save();
            
            if ($result) {
                // Redirección a la página de registro de medicamento
                header('Location: ../views/Medicamento.php');
                exit();
            } else {
                // En caso de error, redirige de nuevo al formulario con un mensaje de error
                $_SESSION['error_registro'] = "Hubo un error al registrar el paciente.";
                header('Location: ../views/paciente.php');
                exit();
            }
        } else {
            // Si el método no es POST, redirige al formulario de registro
            header('Location: ../views/paciente.php');
            exit();
        }
    }

    // Aquí podrías agregar más métodos relacionados con Paciente si fuera necesario
}

// Verifica si el método save debe ser llamado, esto podría ser llamado desde el formulario
if (isset($_POST['submit'])) { // Asegúrate de que tu formulario de paciente tenga un botón con name="submit"
    $controller = new PacienteController();
    $controller->save();
}
?>
