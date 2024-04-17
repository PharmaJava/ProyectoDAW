<?php
require_once '../config/db.php';  
require_once '../models/Usuario.php';
require_once '../controllers/UsuarioController.php';  

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
    header('Location: registro.php');  
    exit();
}
