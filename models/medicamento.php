<?php

require_once '../config/db.php';

class Medicamento {
    private $db;
    private $medicamento_id;
    private $nombre_medicamento;
    private $fecha_inicio;
    private $fecha_fin;
    private $uso;
    private $codigo_nacional;
    private $lote;
    private $fecha_caducidad;
    private $posologia;
    private $via_administracion;
    private $paciente_id;
    public function __construct() {
        $this->db = Database::connect();
    }

    function getPacienteId() {
        return $this->paciente_id;
    }
    // Getters
    function getMedicamentoId() {
        return $this->medicamento_id;
    }

    function getNombreMedicamento() {
        return $this->nombre_medicamento;
    }

    function getFechaInicio() {
        return $this->fecha_inicio;
    }

    function getFechaFin() {
        return $this->fecha_fin;
    }

    function getUso() {
        return $this->uso;
    }

    function getCodigoNacional() {
        return $this->codigo_nacional;
    }

    function getLote() {
        return $this->lote;
    }

    function getFechaCaducidad() {
        return $this->fecha_caducidad;
    }

    function getPosologia() {
        return $this->posologia;
    }

    function getViaAdministracion() {
        return $this->via_administracion;
    }

    // Setters
    function setPacienteId($paciente_id) {
        $this->paciente_id = $paciente_id;
    }

    function setMedicamentoId($medicamento_id) {
        $this->medicamento_id = $medicamento_id;
    }

    function setNombreMedicamento($nombre_medicamento) {
        $this->nombre_medicamento = $this->db->real_escape_string($nombre_medicamento);
    }

    function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    function setFechaFin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    function setUso($uso) {
        $this->uso = $this->db->real_escape_string($uso);
    }

    function setCodigoNacional($codigo_nacional) {
        $this->codigo_nacional = $this->db->real_escape_string($codigo_nacional);
    }

    function setLote($lote) {
        $this->lote = $this->db->real_escape_string($lote);
    }

    function setFechaCaducidad($fecha_caducidad) {
        $this->fecha_caducidad = $fecha_caducidad;
    }

    function setPosologia($posologia) {
        $this->posologia = $this->db->real_escape_string($posologia);
    }

    function setViaAdministracion($via_administracion) {
        $this->via_administracion = $this->db->real_escape_string($via_administracion);
    }

    public function save() {
        $sql = "INSERT INTO Medicamento (medicamento_id,paciente_id,nombre_medicamento, fecha_inicio, fecha_fin, uso, codigo_nacional, lote, fecha_caducidad, posologia, via_administracion) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iisssssssss", $this->medicamento_id, $this->paciente_id,$this->nombre_medicamento, $this->fecha_inicio, $this->fecha_fin, $this->uso, $this->codigo_nacional, $this->lote, $this->fecha_caducidad, $this->posologia, $this->via_administracion);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    public function getMedicamentosByPacienteID($paciente_id) {
        $sql = "SELECT * FROM Medicamento WHERE paciente_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $paciente_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicamentos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $medicamentos;
    }
    
    public function getPacienteById($medicamento_id) {
        $sql = "SELECT * FROM Medicamento WHERE medicamento_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $medicamento_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicamentos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $medicamentos;
    }
    // Aquí puedes agregar más métodos según tus necesidades, como por ejemplo métodos para buscar o actualizar medicamentos.
}
