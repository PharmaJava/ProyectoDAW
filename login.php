<?php
require_once __DIR__ . '/config/db.php';
require_once 'models/Usuario.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->login($username, $password);

    if ($usuario) {
        $_SESSION['username'] = $usuario->getUsername(); // Usa el método getter
        $_SESSION['usuario_id'] = $usuario->getUsuario_id(); // Usa el método getter
        $_SESSION['rol'] = $usuario->getRol(); // Usa el método getter
        if (isset($usuario->paciente_id)) {
            $_SESSION['paciente_id'] = $usuario->paciente_id; // Guarda el paciente_id si está disponible
        }

        // Comprueba el rol del usuario y redirige según corresponda
        if ($usuario->getRol() === 'admin') {
            header("Location: views/admin/AdminDashboard.php");
            exit();
        } elseif ($usuario->getRol() === 'paciente') {
            header("Location: views/paciente/pacientesuccess.php");
            exit();
        } else {
            header("Location: views/success.php");
            exit();
        }
    } else {
        $_SESSION['error_login'] = 'Usuario o contraseña incorrectos';
        header("Location: index.php");
        exit();
    }
}
