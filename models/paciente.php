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
        $sql = "INSERT INTO Paciente (nombre, apellidos, sexo, edad, peso, altura) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssidd', $this->nombre, $this->apellidos, $this->sexo, $this->edad, $this->peso, $this->altura);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    // Otros métodos que necesites...
}
