<?php
session_start();
include('C:\xampp\htdocs\includes\function.php');

// Verificar si el usuario tiene el rol de administrador
checkRole(1);

// Ruta al archivo CSV de usuarios
$csvFile = 'C:\xampp\htdocs\usuario\usuario.csv';


// Obtener todos los usuarios desde el archivo CSV
$usuarios = readCSV($csvFile);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="..\css\style.css">
    <script>
        function confirmDelete(userId) {
            var confirmation = confirm("¿Estás seguro de que deseas eliminar este usuario?");
            if (confirmation) {
                window.location.href = "eliminar_usuario.php?id=" + userId;
            }
        }
    </script>
</head>
<body>
    <?php include '../includes/menu2.php'; ?>
    <h1>Lista de Usuarios</h1>
    <a href="register.php">Registrar Usuario</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Contraseña</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario[0]; ?></td> <!-- ID -->
            <td><?php echo htmlspecialchars($usuario[1], ENT_QUOTES, 'UTF-8'); ?></td> <!-- USERNAME -->
            <td><?php echo htmlspecialchars($usuario[2], ENT_QUOTES, 'UTF-8'); ?></td> <!-- PASS -->
            <td><?php echo htmlspecialchars($usuario[3], ENT_QUOTES, 'UTF-8'); ?></td> <!-- NOMBRE -->
            <td><?php echo htmlspecialchars($usuario[4], ENT_QUOTES, 'UTF-8'); ?></td> <!-- EMAIL -->         

            <td>
                <?php 
                if ($usuario[5] == 1) {
                    echo 'Administrador';
                } elseif ($usuario[5] == 2) {
                    echo 'Médico';
                } else {
                    echo 'Enfermero';
                }
                ?>
            </td>
            <td>
                <a href="editar_usuario.php?id=<?php echo $usuario[0]; ?>">Editar</a>
                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $usuario[0]; ?>)">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
