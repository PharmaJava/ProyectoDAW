<?php
session_start(); // Asegúrate de iniciar la sesión

require_once '../config/db.php'; // Asegúrate de que la ruta es correcta
require_once '../models/Paciente.php';

// Verificar si el usuario está logueado y tiene un usuario_id
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit; // Termina la ejecución del script si no hay usuario logueado
}

$usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario desde la sesión

$paciente = new Paciente();
$pacientes = $paciente->getAllPacientes($usuario_id); // Obtener todos los pacientes asociados al usuario

echo json_encode($pacientes); // Devuelve los pacientes como JSON
?>
