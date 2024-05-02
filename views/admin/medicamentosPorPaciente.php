<?php
require_once '../config/db.php'; 
require_once '../models/Medicamento.php';

if(isset($_GET['paciente_id'])) {
    $paciente_id = $_GET['paciente_id'];
    $medicamento = new Medicamento();
    $medicamentos = $medicamento->getMedicamentosByPacienteID($paciente_id);

    echo json_encode($medicamentos);
}


?>