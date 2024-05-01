<?php
session_start();
require_once '../config/db.php';
require_once '../models/Paciente.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$paciente = new Paciente();
$pacientes = $paciente->getAllPacientes($usuario_id);

echo json_encode($pacientes);
