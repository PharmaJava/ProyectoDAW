<?php

require_once '../config/db.php';
require_once '../models/Usuario.php';

session_start();

class UsuarioController {
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

//   public function save()
//   {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//       $usuario = new Usuario();
//       $usuario->setUsername($_POST['username']);
//       $usuario->setPassword($_POST['password']);
//       $usuario->setNombre($_POST['nombre']);
//       $usuario->setApellidos($_POST['apellidos']);
//       $usuario->setEmail($_POST['email']);
//       $usuario->setRol($_POST['rol']);
//       $usuario->setUsuario_id($_POST['usuario_id']);

//       $result = $usuario->save();

//       if ($result) {
//         // Inicia sesión automáticamente después del registro
//         $this->login($_POST['username'], $_POST['password']);
//     } else {
//         $_SESSION['register'] = 'failed';
//         header('Location: ../views/registro.php');
//     }
// }
//   }
public function save() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario = new Usuario();
      $usuario->setUsername($_POST['username']);
      $usuario->setPassword($_POST['password']); 
      $usuario->setNombre($_POST['nombre']);
      $usuario->setApellidos($_POST['apellidos']);
      $usuario->setEmail($_POST['email']);
      $usuario->setRol($_POST['rol']);

      // Intenta guardar el nuevo usuario en la base de datos
      $result = $usuario->save();

      if ($result) {
          // Si el registro es exitoso, inicia sesión automáticamente con los datos del nuevo usuario
          $this->login($_POST['username'], $_POST['password']);
      } else {
          // Si hay un error en el registro, redirecciona de vuelta al formulario de registro
          $_SESSION['register'] = 'failed';
          header('Location: ../views/registro.php');
          exit();
      }
  }
}
  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obtener datos de la solicitud POST
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Validar la entrada
      if (empty($username) || empty($password)) {
        $_SESSION['error_login'] = 'Por favor, ingresa tu usuario y contraseña.';
        header('Location: ../views/index.php');
        exit();
      }

      // Sanitizar la entrada
      $username = $this->db->real_escape_string($username);
      $password = $this->db->real_escape_string($password);

      // Crear una instancia de Usuario
      $usuario = new Usuario();
      $usuario->setUsername($username);
      $usuario->setPassword($password); // No necesitas hashear aquí si ya lo hiciste en setPassword

      // Iniciar sesión
      $loggedInUser = $usuario->login($_POST['username'], $_POST['password']);

      // Manejar el resultado
      if ($loggedInUser) {
        $_SESSION['username'] = $loggedInUser->username; // Asegúrate de que 'username' es el nombre del campo correcto
        header('Location: ../views/success.php');
        exit();
      } else {
        $_SESSION['error_login'] = 'Autenticación fallida.';
        header('Location: ../views/index.php');
        exit();
      }
    } else {
      // Redirigir al inicio si no es una solicitud POST
      header('Location: ../views/index.php');
      exit();
    }
  }
}

// Crear una instancia y llamar al método adecuado
if (isset($_POST['submit'])) {
  $db = Database::connect(); // Reemplazar con la lógica de conexión a la base de datos
  $usuarioController = new UsuarioController($db);

  if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $usuarioController->login();
  } else {
    $usuarioController->save();
  }
}

?>
