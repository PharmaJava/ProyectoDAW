<?php
require_once '../../config/db.php';
require_once '../../models/usuario.php';
session_start();

// Verifica si el usuario es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Verifica que el ID del usuario a eliminar haya sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario_id'])) {
    $usuario_id = $_POST['usuario_id'];
    $usuario = new Usuario();

    // Llamar al método para borrar usuario
    $resultado = $usuario->borrarUsuario($usuario_id);

    if ($resultado) {
        $_SESSION['message'] = "Usuario eliminado correctamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el usuario.";
    }
} else {
    $_SESSION['error'] = "No se proporcionó un ID de usuario válido.";
}

header('Location: AdminUsuarios.php');
exit();
