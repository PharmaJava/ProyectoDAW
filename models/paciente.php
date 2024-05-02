<?php

// Requerir la conexión a la base de datos

require_once __DIR__ . '/../config/db.php';

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
    
    public function save() {
        $sql = "INSERT INTO paciente (usuario_id, nombre, apellidos, sexo, edad, peso, altura) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('isssidi', $this->usuario_id, $this->nombre, $this->apellidos, $this->sexo, $this->edad, $this->peso, $this->altura);
    
        if ($stmt->execute()) {
            // Asignar el ID del paciente recién creado al objeto paciente
            $this->paciente_id = $stmt->insert_id;
    
            // Retorna el ID para ser usado inmediatamente después en la sesión
            return $this->paciente_id;  
        } else {
            // Retorna false si la inserción falla
            return false;
        }
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

public function getAllPacientes($usuario_id) {
    // Prepara la consulta SQL con un parámetro de sustitución
    $stmt = $this->db->prepare("SELECT paciente_id, nombre FROM paciente WHERE usuario_id = ?");

    // Vincula el parámetro usuario_id a la consulta
    $stmt->bind_param("i", $usuario_id);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene los resultados
    $result = $stmt->get_result();

    // Fetch all rows as an associative array
    $pacientes = $result->fetch_all(MYSQLI_ASSOC);

    // Cierra el statement
    $stmt->close();

    return $pacientes;
}

public function getPacienteById($paciente_id) {
    $sql = "SELECT * FROM Paciente WHERE paciente_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $paciente_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
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
    $sql = "UPDATE Paciente SET nombre = ?, apellidos = ?, sexo = ?, edad = ?, peso = ?, altura = ? WHERE paciente_id = ?";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param('sssiddi', $nombre, $apellidos, $sexo, $edad, $peso, $altura, $paciente_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}  


public function borrarPaciente($paciente_id) {
    // Iniciar transacción
    $this->db->begin_transaction();

    try {
        // Agregar aquí eliminaciones de otras tablas si son necesarias
    
        // Continuar con medicamentos y reacciones como antes
        $sqlReacciones = "DELETE FROM reacciones WHERE medicamento_id IN (SELECT medicamento_id FROM medicamento WHERE paciente_id = ?)";
        $stmtReacciones = $this->db->prepare($sqlReacciones);
        $stmtReacciones->bind_param("i", $paciente_id);
        $stmtReacciones->execute();
        $stmtReacciones->close();

        $sqlMedicamento = "DELETE FROM medicamento WHERE paciente_id = ?";
        $stmtMedicamento = $this->db->prepare($sqlMedicamento);
        $stmtMedicamento->bind_param("i", $paciente_id);
        $stmtMedicamento->execute();
        $stmtMedicamento->close();

        // Borrar el paciente
        $sqlPaciente = "DELETE FROM Paciente WHERE paciente_id = ?";
        $stmtPaciente = $this->db->prepare($sqlPaciente);
        $stmtPaciente->bind_param("i", $paciente_id);
        $stmtPaciente->execute();
        $stmtPaciente->close();

        // Si todo fue bien, confirmar la transacción
        $this->db->commit();
        return true;
    } catch (Exception $e) {
        // Si algo falla, hacer rollback
        $this->db->rollback();
        error_log("Error durante la eliminación del paciente y sus dependencias: " . $e->getMessage());
        return false;
    }
}


}
