<?php

require_once '../config/db.php'; // Asegúrate de que la ruta al archivo de conexión sea correcta

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
    

}

?>
