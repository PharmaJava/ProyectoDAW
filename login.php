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
        $_SESSION['username'] = $usuario->username; // Guarda el nombre de usuario en la sesión
        $_SESSION['usuario_id'] = $usuario->usuario_id; // Guarda el ID del usuario en la sesión
        $_SESSION['rol'] = $usuario->rol; // Guarda el rol del usuario en la sesión
        if (isset($usuario->paciente_id)) {
            $_SESSION['paciente_id'] = $usuario->paciente_id; // Guarda el paciente_id si está disponible
        }

        // Comprueba el rol del usuario y redirige según corresponda
        if ($usuario->rol === 'admin') {
            header("Location: views/admin/AdminDashboard.php");
            exit();
        } elseif ($usuario->rol === 'paciente') {
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
