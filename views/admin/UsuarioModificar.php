<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>
<body>
<div class="full-page-form">
    <?php
    require_once '../../config/db.php';
    require_once '../../models/usuario.php';
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
        header('Location: index.php');
        exit();
    }

    $usuario = new Usuario();

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Intento de actualizar el usuario
        $usuario_id = $_POST['usuario_id'];
        $username = $_POST['username'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $rol = $_POST['rol'];

        // Asumimos que existe un método para actualizar los datos en Usuario
        $resultado = $usuario->actualizarUsuario($usuario_id, $username, $nombre, $apellidos, $email, $rol);

        if ($resultado) {
            echo "<p>Usuario actualizado correctamente.</p>";
            header("Refresh: 2; URL=AdminUsuarios.php");
        } else {
            echo "<p>Error al actualizar los datos del usuario.</p>";
        }
    } elseif (isset($_POST['usuario_id'])) {
        // Mostrar el formulario con los datos actuales del usuario
        $usuario_info = Usuario::find($_POST['usuario_id']);

        if ($usuario_info) {
            ?>
            
            <h2>Modificar Usuario</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="usuario_id" value="<?php echo $usuario_info->getUsuario_id(); ?>">
                               <label for="username">Nombre de Usuario:</label>
                    <input type="text" id="username" name="username" value="<?php echo $usuario_info->getUsername(); ?>" required>
                
                <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $usuario_info->getNombre(); ?>" required>
                
                <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario_info->getApellidos(); ?>" required>
                
                                   <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $usuario_info->getEmail(); ?>" required>
                
                                    <label for="rol">Rol:</label>
                    <select id="rol" name="rol" required>
                            <option value="admin" <?php echo $usuario_info->getRol() == 'admin' ? 'selected' : ''; ?>>Admin</option>
                            <option value="paciente" <?php echo $usuario_info->getRol() == 'paciente' ? 'selected' : ''; ?>>Paciente</option>
                            <option value="sanitario" <?php echo $usuario_info->getRol() == 'sanitario' ? 'selected' : ''; ?>>Sanitario</option>
                        </select>

                        <button type="submit" name="submit" class='btn btn-modificar'>Modificar</button>
                        <a href="AdminUsuarios.php" class="btn">Volver</a>
                        </form>

        </div>
                        <?php
                            } else {
                                echo "<p>No se encontraron datos del usuario. Asegúrese de que el ID es correcto.</p>";
                            }
                            } else {
                            echo "<p>No se ha proporcionado un ID de usuario válido.</p>";
                        }
                        ?>

</div>
</body>
</html>
