<?php
require_once '../config/db.php';  // Ajusta la ruta según sea necesario.
require_once '../models/Usuario.php';  // Ajusta la ruta según sea necesario.
require_once '../controllers/UsuarioController.php';  // Ajusta la ruta según sea necesario.

// Iniciar sesión para poder usar las variables de sesión.
session_start();

// Comprueba si hemos recibido los datos del formulario.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear una instancia del controlador.
    $usuarioController = new UsuarioController();
    
    // Llamar al método para guardar los datos.
    $usuarioController->save();
} else {
    // Redireccionar o manejar el error como se desee.
    header('Location: registro.php');  // Ajusta la ruta según sea necesario.
    exit();
}
