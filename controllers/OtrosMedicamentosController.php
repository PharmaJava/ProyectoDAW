<?php
require_once '../models/OtrosMedicamentos.php'; // Asegúrate de que el path al modelo es correcto.
require_once '../config/db.php';

session_start();
class OtrosMedicamentosController {

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                // Redireccionar a la página de éxito
                header('Location: ../views/success.php');
            
            } else {
                // Redireccionar a la página de error o mostrar un mensaje
                header('Location: ../views/OtrosMedicamentos.php'); // Asume que tienes una vista error.php
            
            }
        } else {
            // Redireccionar o mostrar error si el método no es POST o si no se envían datos
            header('HTTP/1.1 405 Method Not Allowed');
            exit("Método no permitido o datos no enviados");
        }
    }
}

// Instanciar y llamar al método 'save' si se solicita
if (isset($_POST['submit'])) {
    $controller = new OtrosMedicamentosController();
    $controller->save();
}
