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
        $_SESSION['username'] = $usuario->username; // Asegúrate de que 'username' es el campo correcto
        header("Location: views/success.php");
        exit();
    } else {
        $_SESSION['error_login'] = 'Usuario o contraseña incorrectos';
        header("Location: views/index.php");
        exit();
    }
}
?>
