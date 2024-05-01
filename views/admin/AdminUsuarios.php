<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/stylee.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f2f2f2;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    require_once '../../config/db.php';
    require_once '../../models/usuario.php';
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
        header('Location: index.php');
        exit();
    }

    $usuarioModel = new Usuario();
    $usuarios = $usuarioModel->all();  // Asegúrate que esta función devuelve todos los usuarios

    echo '<h1>Administrar Usuarios</h1>';
    echo '<table id="myTable">';
    echo '<thead>';
    echo '<tr><th>ID</th><th>Nombre de Usuario</th><th>Rol</th><th>Acciones</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($usuarios as $usuario) {
        echo "<tr>";
        echo "<td>{$usuario->getUsuario_id()}</td>";
        echo "<td>{$usuario->getUsername()}</td>";
        echo "<td>{$usuario->getRol()}</td>";
        echo "<td>";
        echo "<form action='UsuarioModificar.php' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='usuario_id' value='{$usuario->getUsuario_id()}'>";
        echo "<input type='submit' value='Editar' class='button'>";
        echo "</form> ";
        echo "<form action='borrar_usuario.php' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='usuario_id' value='{$usuario->getUsuario_id()}'>";
        echo "<input type='submit' value='Eliminar' class='button'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';
    ?>
    <a href="AdminDashboard.php" class="button">Volver al Dashboard</a>
</div>

<script src="script.js"></script>
</body>
</html>
