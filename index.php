<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Aplicación de Gestión de Medicamentos</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
<div class="title-container">
    <h1>Notificación de RAM</h1>
</div>
<div class="container">
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Nombre de Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="hidden" name="action" value="login">
            <button name="submit" type="submit">Iniciar Sesión</button>
        </form>
        <div class="register-container">
            <h2>¿No estás registrado? <a href="views/registro.php">Haz clic aquí para registrarte</a></h2>
        </div>
    </div>
</div>
</body>
</html>
