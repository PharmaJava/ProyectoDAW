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

    public function __construct() {
        $this->db = Database::connect();
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
        $sql = "INSERT INTO Medicamento (nombre_medicamento, fecha_inicio, fecha_fin, uso, codigo_nacional, lote, fecha_caducidad, posologia, via_administracion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssssss", $this->nombre_medicamento, $this->fecha_inicio, $this->fecha_fin, $this->uso, $this->codigo_nacional, $this->lote, $this->fecha_caducidad, $this->posologia, $this->via_administracion);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Aquí puedes agregar más métodos según tus necesidades, como por ejemplo métodos para buscar o actualizar medicamentos.
}
