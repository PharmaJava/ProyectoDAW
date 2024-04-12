<!-- views/index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Aplicación de Gestión de Medicamentos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <br>
    <h1>Bienvenido al Sistema de Notificación de Reacciones Adversas Medicamentosas</h1>
    <br>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <br>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Nombre de Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button name="submit" type="submit">Iniciar Sesión</button>
        </form>
    </div>
    <br>
    <div class="register-container">
        <h2>¿No estás registrado? <a href="registro.php">Haz clic aquí para registrarte</a></h2>
    </div>
</body>
</html>
