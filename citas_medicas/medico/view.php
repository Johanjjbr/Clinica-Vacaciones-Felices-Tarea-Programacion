<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole([1, 2]);

$sql = "SELECT * FROM medicos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Médicos</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function confirmDelete(userId) {
            var confirmation = confirm("¿Estás seguro de que deseas eliminar este usuario?");
            if (confirmation) {
                window.location.href = "./delete.php?id=" + userId;
            }
        }
    </script>
</head>
<body>
<?php include '../includes/menu2.php'; ?>

<div class="content">
    <h1>Lista de Médicos</h1>
    <a href="add.php">Agregar Médico</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Turno</th>
            <th>Disponibilidad</th>
            <th>Acciones</th>
            
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['CODM']; ?></td>
            <td><?php echo $row['NOMBRE']; ?></td>
            <td><?php echo $row['ESPECIALIDAD']; ?></td>
            <td><?php echo $row['TURNO']; ?></td>
            <td><?php echo $row['DISPONIBILIDAD']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['CODM']; ?>">Editar</a>
                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['CODM']; ?>)">Eliminar</a>
                <a href="historial.php?id=<?php echo $row['CODM']; ?>">Historial</a>

            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="../index.php">Volver al Panel de Control</a> 
    </div>  
</body>
</html>
