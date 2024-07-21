<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador


$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <a href="register.php">Registrar Usuario</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['USERNAME']; ?></td>
            <td><?php echo $row['NOMBRE']; ?></td>
            <td><?php echo $row['EMAIL']; ?></td>
            <td><?php echo $row['ROLE'] == 1 ? 'Administrador' : ($row['ROLE'] == 2 ? 'Médico' : 'Enfermero'); ?></td>
            <td>
                <a href="editar_usuario.php?id=<?php echo $row['ID']; ?>">Editar</a>
                <a href="eliminar_usuario.php?id=<?php echo $row['ID']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
