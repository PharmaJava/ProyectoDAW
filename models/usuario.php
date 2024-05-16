<?php

// Requerir la conexión a la base de datos

require_once __DIR__ . '/../config/db.php';

class Usuario {

  private $usuario_id;
  private $username;
  private $password;
  private $nombre;
  private $apellidos;
  private $email;
  private $rol;
  private $db;

  public function __construct() {
    // Conectar a la base de datos
    $this->db = Database::connect();
  }

  // Getters
  public function getUsuario_id() {
    return $this->usuario_id;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getApellidos() {
    return $this->apellidos;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getRol() {
    return $this->rol;
  }

  // Setters
  public function setUsuario_id($usuario_id) {
    $this->usuario_id = $usuario_id;
  }

  public function setUsername($username) {
    $this->username = $this->db->real_escape_string($username);
  }

  public function setPassword($password) {
    $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
  }

  public function setNombre($nombre) {
    $this->nombre = $this->db->real_escape_string($nombre);
  }

  public function setApellidos($apellidos) {
    $this->apellidos = $this->db->real_escape_string($apellidos);
  }

  public function setEmail($email) {
    $this->email = $this->db->real_escape_string($email);
  }

  public function setRol($rol) {
    $this->rol = $rol;
  }

  public function save() {
    // Asumiendo que has sanitizado y validado los datos de entrada apropiadamente
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Asegúrate de hashear la contraseña
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    $sql = "INSERT INTO Usuarios (username, password, nombre, apellidos, email, rol) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        $_SESSION['register'] = 'failed';
        return false;
    }

    $stmt->bind_param('ssssss', $username, $password, $nombre, $apellidos, $email, $rol);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function login($username, $password) {
    $sql = "SELECT u.*, p.paciente_id FROM Usuarios u LEFT JOIN Paciente p ON u.usuario_id = p.usuario_id WHERE u.username = ?";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $this->db->error;
        return false;
    }
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && (password_verify($password, $usuario['password']) || $password === $usuario['password'])) {
        if ($password === $usuario['password']) {
            $this->updatePasswordHash($usuario['usuario_id'], $password);
        }
        // Crear una instancia de Usuario y establecer sus propiedades
        $usuarioObj = new Usuario();
        $usuarioObj->setUsuario_id($usuario['usuario_id']);
        $usuarioObj->setUsername($usuario['username']);
        $usuarioObj->setPassword($usuario['password']);
        $usuarioObj->setNombre($usuario['nombre']);
        $usuarioObj->setApellidos($usuario['apellidos']);
        $usuarioObj->setEmail($usuario['email']);
        $usuarioObj->setRol($usuario['rol']);
        if (isset($usuario['paciente_id'])) {
            $usuarioObj->paciente_id = $usuario['paciente_id'];
        }

        $stmt->close();
        return $usuarioObj;
    }

    $stmt->close();
    return false;
}

  public function updatePasswordHash($usuario_id, $password) {
    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    $sql = "UPDATE Usuarios SET password = ? WHERE usuario_id = ?";
    $stmt = $this->db->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('si', $hash, $usuario_id);
        $stmt->execute();
        $stmt->close();
    }
  }

public static function find($usuario_id) {
  $db = Database::connect();
  $sql = "SELECT * FROM Usuarios WHERE usuario_id = ?";
  $stmt = $db->prepare($sql);

  if (!$stmt) {
      error_log("Error preparando la consulta: " . $db->error);
      return null;
  }

  $stmt->bind_param('i', $usuario_id);
  if (!$stmt->execute()) {
      error_log("Error ejecutando la consulta: " . $stmt->error);
      $stmt->close();
      return null;
  }

  $result = $stmt->get_result();
  $stmt->close();

  $userData = $result->fetch_assoc();
  if ($userData) {
      return new Usuario($userData); // Asegúrate de que el constructor de Usuario puede manejar un array
  } else {
      return null;
  }
}


public static function all() {
  $db = Database::connect();
  $sql = "SELECT * FROM Usuarios";
  $result = $db->query($sql);
  $usuarios = array();
  while ($row = $result->fetch_assoc()) {
      $usuario = new Usuario();
      $usuario->setUsuario_id($row['usuario_id']);
      $usuario->setUsername($row['username']);
      $usuario->setRol($row['rol']);
      $usuario->setPassword($row['password']);
      $usuario->setNombre($row['nombre']);
      $usuario->setApellidos($row['apellidos']);
      $usuario->setEmail($row['email']);
      
      $usuarios[] = $usuario;
  }
  return $usuarios;
}


public function actualizarUsuario($usuario_id, $username, $nombre, $apellidos, $email, $rol) {


  $sql = "UPDATE Usuarios SET username = ?, nombre = ?, apellidos = ?, email = ?, rol = ? WHERE usuario_id = ?";
  $stmt = $this->db->prepare($sql);
  if (!$stmt) {
      error_log("Error preparando la declaración: " . $this->db->error);
      return false;
  }

  $stmt->bind_param('sssssi', $username, $nombre, $apellidos, $email, $rol, $usuario_id);
  $executeResult = $stmt->execute();
  if (!$executeResult) {
      error_log("Error al ejecutar la actualización: " . $stmt->error);
      $stmt->close();
      return false;
  }

  $stmt->close();
  return $executeResult;
}


public static function countAll() {
    $db = Database::connect();
    $sql = "SELECT COUNT(*) AS count FROM Usuarios";
    $result = $db->query($sql);
    $data = $result->fetch_object();
    return $data->count;
}


//   public function login($username, $password) {
//     $sql = "SELECT u.*, p.paciente_id FROM Usuarios u LEFT JOIN Paciente p ON u.usuario_id = p.usuario_id WHERE u.username = ?";
//     $stmt = $this->db->prepare($sql);
//     if (!$stmt) {
//         echo "Error preparing statement: " . $this->db->error;
//         return false;
//     }
//     $stmt->bind_param('s', $username);
//     $stmt->execute();
//     $usuario = $stmt->get_result()->fetch_object();

//     if ($usuario) {
//         // Verificar si la contraseña es hash o no
//         if (password_verify($password, $usuario->password)) {
//             $stmt->close();
//             return $usuario; // Retorna el objeto usuario si el login es exitoso
//         } elseif ($password === $usuario->password) {
//             // La contraseña coincide directamente, actualizamos a hash
//             $this->updatePasswordHash($usuario->usuario_id, $password);
//             $stmt->close();
//             return $usuario; // Retorna el objeto usuario
//         }
//     }
//     $stmt->close();
//     return false; // Retorna falso si el login falla
// }

//   /// Método para actualizar la contraseña a hash
// public function updatePasswordHash($usuario_id, $password) {
//   $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
//   $sql = "UPDATE Usuarios SET password = ? WHERE usuario_id = ?";
//   $stmt = $this->db->prepare($sql);
//   if ($stmt) {
//       $stmt->bind_param('si', $hash, $usuario_id);
//       $stmt->execute();
//       $stmt->close();
//   }
// }

public function borrarUsuario($usuario_id) {
  $sql = "DELETE FROM Usuarios WHERE usuario_id = ?";
  $stmt = $this->db->prepare($sql);
  if (!$stmt) {
      error_log('Error de preparación: ' . $this->db->error);
      return false;
  }

  $stmt->bind_param('i', $usuario_id);
  $executeResult = $stmt->execute();
  $stmt->close();

  return $executeResult;
}

}
?>