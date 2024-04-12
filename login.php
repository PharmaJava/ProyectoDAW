<?php
require_once __DIR__ . '/config/db.php';
require_once 'models/Usuario.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->login($username, $password);

    if ($usuario && isset($usuario->usuario_id)) {
        $_SESSION['username'] = $usuario->username; // Asumiendo que 'username' es el campo correcto
        $_SESSION['usuario_id'] = $usuario->usuario_id; // Almacenar el usuario_id en la sesión
        header("Location: views/success.php");
        exit();
    } else {
        $_SESSION['error_login'] = 'Usuario o contraseña incorrectos';
        header("Location: ../login.php");
        exit();
    }
}
?>
