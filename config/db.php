<?php

class Database {
  public static function connect() {
      // Configuración de conexión
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'proyectodaw';

      // Crear conexión
      $db = new mysqli($host, $user, $password, $database);

      // Verificar conexión
      if ($db->connect_error) {
          die("La conexión a la base de datos ha fallado: " . $db->connect_error);
      }

      // Configurar la codificación de caracteres a UTF-8
      $db->query("SET NAMES 'utf8'");

      return $db;
  }
}
