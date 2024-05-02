<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
<div class="full-page-form">
  <h1>Formulario de Registro de Usuario</h1>

  <form action="../controllers/UsuarioController.php" method="post">
    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="rol">Rol:</label>
    <select id="rol" name="rol">
      <option value="sanitario">Sanitario</option>
      <option value="paciente">Paciente</option>
    </select>
    
    <input type="hidden" name="action" value="register">
    <button type="submit" name="submit">Registrar</button>
    <a href="../index.php" class="btn">Volver</a>
  </form>
</div>
</body>
</html>
