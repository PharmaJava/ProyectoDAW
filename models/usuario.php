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

  // Métodos adicionales
  public function save() {
    $sql = "INSERT INTO Usuarios (username, password, nombre, apellidos, email, rol, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param('ssssssi', $this->username, $this->password, $this->nombre, $this->apellidos, $this->email, $this->rol, $this->usuario_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public static function find($usuario_id) {
    $sql = "SELECT * FROM Usuarios WHERE usuario_id = ?";
    $stmt = Database::connect()->prepare($sql);
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_object('Usuario');
  }

  public static function all() {
    $sql = "SELECT * FROM Usuarios";
    $result = Database::connect()->query($sql);
    $usuarios = array();
    while ($row = $result->fetch_object()) {
      $usuarios[] = new Usuario($row);
    }
    return $usuarios;
  }

  public function login($username, $password) {
    $sql = "SELECT * FROM Usuarios WHERE username = ?";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $this->db->error;
        return false;
    }
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_object();

    if ($usuario) {
        // Verificar si la contraseña es hash o no
        if (password_verify($password, $usuario->password)) {
            $stmt->close();
            return $usuario; // Retorna el objeto usuario si el login es exitoso
        } elseif ($password === $usuario->password) {
            // La contraseña coincide directamente, actualizamos a hash
            $this->updatePasswordHash($usuario->usuario_id, $password);
            $stmt->close();
            return $usuario; // Retorna el objeto usuario
        }
    }
    $stmt->close();
    return false; // Retorna falso si el login falla
}
  /// Método para actualizar la contraseña a hash
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
}

?>