<?php
require_once '../models/Usuario.php';
session_start();

if (isset($_POST['login'])) {
    $usuario = new Usuario();
    $usuario->setUsername($_POST['username']);
    $usuario->setPassword($_POST['password']);
    $identity = $usuario->login();

    if ($identity && is_object($identity)) {
        $_SESSION['identity'] = $identity;
        
        // Redireccionar al usuario basándose en su rol
        if ($identity->rol == 'paciente') {
            header('Location: ../views/paciente.php');
        } else {
            // Redirigir a otro lugar si no es un paciente
            header('Location: ../views/otraVista.php');
        }
    } else {
        $_SESSION['error_login'] = 'Identificación fallida';
        header('Location: ../views/index.php');
    }
} else {
    header('Location: ../views/index.php');
}
?>
