<?php
require_once '../config/db.php';// Asegúrate de que la ruta es correcta

class OtrosMedicamentos {
    private $id;
    private $paciente_id;
    private $nombreMedicamento;
    private $posologia;
    private $fechaInicio;
    private $fechaFin;
    private $usoMedicacion;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    function getPacienteId() {
        return $this->paciente_id;
    }

    public function getNombreMedicamento() {
        return $this->nombreMedicamento;
    }

    public function getPosologia() {
        return $this->posologia;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function getUsoMedicacion() {
        return $this->usoMedicacion;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    function setPacienteId($paciente_id) {
        $this->paciente_id = $paciente_id;
    }

    public function setNombreMedicamento($nombreMedicamento) {
        $this->nombreMedicamento = $this->db->real_escape_string($nombreMedicamento);
    }

    public function setPosologia($posologia) {
        $this->posologia = $this->db->real_escape_string($posologia);
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function setUsoMedicacion($usoMedicacion) {
        $this->usoMedicacion = $this->db->real_escape_string($usoMedicacion);
    }

    // Método para guardar en la base de datos
    public function save() {
        $sql = "INSERT INTO OtrosMedicamentos (nombre_medicamento, posologia, fecha_inicio, fecha_fin, uso_medicacion,paciente_id) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssi", $this->nombreMedicamento, $this->posologia, $this->fechaInicio, $this->fechaFin, $this->usoMedicacion,$this->paciente_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Otros métodos que puedas necesitar...
}
