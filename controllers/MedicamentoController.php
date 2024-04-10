<?php

require_once '../models/Medicamento.php';

class MedicamentoController {

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva instancia de Medicamento
            $medicamento = new Medicamento();

            // Asignar valores a las propiedades del objeto Medicamento
            $medicamento->setNombreMedicamento($_POST['nombre_medicamento']);
            $medicamento->setFechaInicio($_POST['fecha_inicio']);
            $medicamento->setFechaFin($_POST['fecha_fin']);
            $medicamento->setUso($_POST['uso']);
            $medicamento->setCodigoNacional($_POST['codigo_nacional']);
            $medicamento->setLote($_POST['lote']);
            $medicamento->setFechaCaducidad($_POST['fecha_caducidad']);
            $medicamento->setPosologia($_POST['posologia']);
            $medicamento->setViaAdministracion($_POST['via_administracion']);

            // Guardar el medicamento en la base de datos
            $result = $medicamento->save();

            // Verificar el resultado de la operación y redireccionar o informar al usuario
            if ($result) {
                // Redireccionar a la página de éxito, ajustar según sea necesario
                header('Location: ../views/success.php');
            } else {
                // Redireccionar a la página de error, ajustar según sea necesario
                header('Location: ../views/error.php');
            }
        } else {
            // Redireccionar o mostrar error si el método no es POST o si no se envían datos
            header('HTTP/1.1 405 Method Not Allowed');
            exit("Método no permitido o datos no enviados");
        }
    }

    // Aquí podrías agregar más métodos relacionados con 'Medicamento'
}

// Verificar si se ha llamado al método 'save' a través de un formulario
if (isset($_POST['submit']))  {
    $controller = new MedicamentoController();
    $controller->save();
}

?>
