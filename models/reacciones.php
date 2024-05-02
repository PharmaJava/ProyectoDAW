<?php

require_once __DIR__. '/../config/db.php';

class Reacciones {
    private $id;
    private $paciente_id;
    private $medicamento_id;
    private $sintoma;
    private $fecha_inicio;
    private $fecha_fin;
    private $estado_actual;
    private $otros_datos_interes;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters y Setters
    function getId() {
        return $this->id;
    }

    function getPacienteId() {
        return $this->paciente_id;
    }

    function getMedicamentoId() {
        return $this->medicamento_id;
    }

    function getSintoma() {
        return $this->sintoma;
    }

    function getFechaInicio() {
        return $this->fecha_inicio;
    }

    function getFechaFin() {
        return $this->fecha_fin;
    }

    function getEstadoActual() {
        return $this->estado_actual;
    }

    function getOtrosDatosInteres() {
        return $this->otros_datos_interes;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPacienteId($paciente_id) {
        $this->paciente_id = $paciente_id;
    }

    function setMedicamentoId($medicamento_id) {
        $this->medicamento_id = $medicamento_id;
    }

    function setSintoma($sintoma) {
        $this->sintoma = $this->db->real_escape_string($sintoma);
    }

    function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    function setFechaFin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    function setEstadoActual($estado_actual) {
        $this->estado_actual = $estado_actual;
    }

    function setOtrosDatosInteres($otros_datos_interes) {
        $this->otros_datos_interes = $this->db->real_escape_string($otros_datos_interes);
    }

    public function save() {
        $sql = "INSERT INTO Reacciones (paciente_id, medicamento_id, sintoma, fecha_inicio, fecha_fin, estado_actual, otros_datos_interes) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisssss", $this->paciente_id, $this->medicamento_id, $this->sintoma, $this->fecha_inicio, $this->fecha_fin, $this->estado_actual, $this->otros_datos_interes);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    public function getReacciones() {
        $sql = "SELECT r.*, p.nombre AS nombre_paciente, m.nombre_medicamento
                FROM Reacciones r
                JOIN Paciente p ON r.paciente_id = p.paciente_id
                JOIN Medicamento m ON r.medicamento_id = m.medicamento_id";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
    

public function getReaccionById($id) {
    $sql = "SELECT * FROM Reacciones WHERE id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reaccion = $result->fetch_assoc();
    $stmt->close();
    return $reaccion;
}
public function actualizarReaccion($reaccion_id, $sintoma, $fecha_inicio, $fecha_fin, $estado_actual, $otros_datos_interes) {
    $sql = "UPDATE Reacciones SET sintoma = ?, fecha_inicio = ?, fecha_fin = ?, estado_actual = ?, otros_datos_interes = ? WHERE id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("sssssi", $sintoma, $fecha_inicio, $fecha_fin, $estado_actual, $otros_datos_interes, $reaccion_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

public function eliminarReaccion($reaccion_id) {
    // Prepara la consulta SQL para eliminar la reacción según su ID
    $stmt = $this->db->prepare("DELETE FROM reacciones WHERE id = ?");

    // Vincula el parámetro de ID de reacción a la consulta
   $stmt-> bind_param("i", $reaccion_id);

    // Ejecuta la consulta
    $resultado = $stmt->execute();

    // Cierra el statement
    $stmt->close();

    // Devuelve verdadero si la eliminación fue exitosa, falso en caso contrario
    return $resultado;
}



}
?>
