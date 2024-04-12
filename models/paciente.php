<?php

// Requerir la conexión a la base de datos
require_once '../config/db.php';

class Paciente {
    private $paciente_id;
    private $usuario_id;
    private $nombre;
    private $apellidos;
    private $sexo;
    private $edad;
    private $peso;
    private $altura;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters
    public function getPaciente_id() {
        return $this->paciente_id;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getAltura() {
        return $this->altura;
    }

    // Setters
    public function setPaciente_id($paciente_id) {
        $this->paciente_id = $paciente_id;
    }

    public function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }
    
    // Método para guardar un paciente
    public function save() {
        $sql = "INSERT INTO Paciente (usuario_id, nombre, apellidos, sexo, edad, peso, altura,paciente_id) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('isssiddi', $this->usuario_id, $this->nombre, $this->apellidos, $this->sexo, $this->edad, $this->peso, $this->altura,$this->paciente_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }


public function getPacientesByUsuarioId($usuario_id) {
    $sql = "SELECT * FROM Paciente WHERE usuario_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pacientes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $pacientes;
}

public function getPacienteById($paciente_id) {
    $sql = "SELECT * FROM Paciente WHERE paciente_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $paciente_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pacientes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $pacientes;
}

public function borrarPaciente($paciente_id) {
    $sql = "DELETE FROM Paciente WHERE paciente_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $paciente_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
public function all() {
    $sql = "SELECT * FROM Paciente"; // Asegúrate que el nombre de la tabla es correcto
    $result = $this->db->query($sql);
    
    $pacientes = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_object('Paciente')) {
            $pacientes[] = $row;
        }
    }
    return $pacientes;
}
// En la clase Paciente

public function actualizarPaciente($paciente_id, $nombre, $apellidos, $sexo, $edad, $peso, $altura) {

    // Preparar la consulta
$query = "UPDATE Paciente SET nombre = :nombre, apellidos = :apellidos, sexo = :sexo, edad = :edad, peso = :peso, altura = :altura WHERE paciente_id = :paciente_id";

// Preparar la declaración
$statement = $this->conn->prepare($query);

// Verificar si la preparación de la declaración fue exitosa
if (!$statement) {
    // Retornar false si la preparación de la declaración falló
    return false;
}

// Vincular los parámetros
$statement->bindParam(':nombre', $nombre);
$statement->bindParam(':apellidos', $apellidos);
$statement->bindParam(':sexo', $sexo);
$statement->bindParam(':edad', $edad, PDO::PARAM_INT);
$statement->bindParam(':peso', $peso);
$statement->bindParam(':altura', $altura);
$statement->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);

// Ejecutar la declaración
if ($statement->execute()) {
    // La actualización fue exitosa, retornar true
    return true;
} else {
    // La actualización falló, retornar false
    return false;
}

    
    // Otros métodos que necesites...
}
}
