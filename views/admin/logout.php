<?php
// logout.php
session_start(); // Asegúrate de que la sesión se haya iniciado
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión
header("Location: ../../index.php"); // Redireccionar al index
exit();
?>
