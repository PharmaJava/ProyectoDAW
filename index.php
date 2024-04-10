<?php
require_once 'config/parameters.php';
require_once 'autoload.php'; // Asegúrate de cargar tus clases
require_once './config/db.php';
// Lógica para parsear la URL y determinar el controlador y acción
$controllerName = controller_default;
$actionName = action_default;

if(isset($_GET['controller'])) {
    $controllerName = $_GET['controller'].'Controller';
}

if(isset($_GET['action']) && method_exists($controllerName, $_GET['action'])) {
    $actionName = $_GET['action'];
}

// Instancia el controlador y llama a la acción
$controller = new $controllerName();
$controller->$actionName();
