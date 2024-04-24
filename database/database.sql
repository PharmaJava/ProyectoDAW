    -- Active: 1709293761758@@127.0.0.1@3306@proyectodaw
    -- Crear la base de datos
    CREATE DATABASE IF NOT EXISTS ProyectoDAW;

    USE ProyectoDAW;

    CREATE TABLE IF NOT EXISTS Usuarios (
        usuario_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        apellidos VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        rol ENUM('admin', 'sanitario', 'paciente') NOT NULL
    );

    CREATE TABLE IF NOT EXISTS Paciente (
        paciente_id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        apellidos VARCHAR(100) NOT NULL,
        sexo ENUM('masculino', 'femenino', 'otro') NOT NULL,
        edad INT NOT NULL,
        peso DECIMAL(5,2) NOT NULL,
        altura DECIMAL(3,2) NOT NULL,
        FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
    );


    CREATE TABLE IF NOT EXISTS Medicamento (
        medicamento_id INT AUTO_INCREMENT PRIMARY KEY,
        paciente_id INT NOT NULL,
        nombre_medicamento VARCHAR(100) NOT NULL,
        fecha_inicio DATE NOT NULL,
        fecha_fin DATE,
        uso VARCHAR(255),
        codigo_nacional VARCHAR(50),
        lote VARCHAR(50),
        fecha_caducidad DATE,
        posologia TEXT,
        via_administracion ENUM('oral', 'parenteral', 'topica', 'otra') NOT NULL,
        FOREIGN KEY (paciente_id) REFERENCES Paciente(paciente_id)
    );

    CREATE TABLE IF NOT EXISTS Reacciones (
        id INT AUTO_INCREMENT PRIMARY KEY,
        paciente_id INT NOT NULL,
        medicamento_id INT NOT NULL,
        sintoma TEXT NOT NULL,
        fecha_inicio DATE NOT NULL,
        fecha_fin DATE,
        estado_actual ENUM('resuelto', 'pendiente', 'en tratamiento', 'otro') NOT NULL,
        otros_datos_interes TEXT,
        FOREIGN KEY (paciente_id) REFERENCES Paciente(paciente_id),
        FOREIGN KEY (medicamento_id) REFERENCES Medicamento(medicamento_id)
    );

    CREATE TABLE IF NOT EXISTS OtrosMedicamentos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        paciente_id INT NOT NULL,
        nombre_medicamento VARCHAR(100) NOT NULL,
        posologia TEXT,
        fecha_inicio DATE NOT NULL,
        fecha_fin DATE,
        uso_medicacion TEXT,
        FOREIGN KEY (paciente_id) REFERENCES Paciente(paciente_id)
    );
