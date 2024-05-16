<?php
require_once '../config/db.php';
require_once '../models/Usuario.php';

session_start();

class UsuarioController {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($this->db);
            $usuario->setUsername($_POST['username']);
            $usuario->setPassword($_POST['password']);
            $usuario->setNombre($_POST['nombre']);
            $usuario->setApellidos($_POST['apellidos']);
            $usuario->setEmail($_POST['email']);
            $usuario->setRol($_POST['rol']);

            $result = $usuario->save();

            if ($result) {
                $this->login($_POST['username'], $_POST['password']); // Realiza login después del registro
            } else {
                $_SESSION['register'] = 'failed';
                header('Location: ../views/registro.php');
                exit();
            }
        }
    }

    public function login($username, $password) {
        $usuario = new Usuario($this->db);
        $loggedInUser = $usuario->login($username, $password);

        if ($loggedInUser) {
            $_SESSION['username'] = $loggedInUser->getUsername();
            $_SESSION['usuario_id'] = $loggedInUser->getUsuario_id();
            $_SESSION['rol'] = $loggedInUser->getRol();

            if (isset($loggedInUser->paciente_id)) {
                $_SESSION['paciente_id'] = $loggedInUser->paciente_id;
            }

            $this->redirectByRole($_SESSION['rol']); // Redirige según el rol
        } else {
            $_SESSION['error_login'] = 'Autenticación fallida.';
            header('Location: ../views/index.php');
            exit();
        }
    }

    private function redirectByRole($role) {
        switch ($role) {
            case 'sanitario':
                header('Location: ../views/success.php');
                break;
            case 'paciente':
                header('Location: ../views/paciente/pacientesuccess.php');
                break;
            default:
                header('Location: ../views/index.php');
                break;
        }
        exit();
    }
}

if (isset($_POST['submit'])) {
    $usuarioController = new UsuarioController();
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $usuarioController->save();
    } else if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $usuarioController->login($_POST['username'], $_POST['password']);
    }
}
?>
