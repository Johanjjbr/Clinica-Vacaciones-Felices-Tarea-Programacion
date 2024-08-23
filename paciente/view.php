<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
checkRole([1, 2]);

// Obtener todos los pacientes
$query = "SELECT * FROM pacientes";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Pacientes - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function confirmDelete(pacienteId) {
            var confirmation = confirm("¿Estás seguro de que deseas eliminar este Paciente?");
            if (confirmation) {
                window.location.href = "delete.php?id=" + pacienteId;
            }
        }
    </script>
</head>
<body>
<?php include '../includes/menu2.php'; ?>

<div class="content"><h1>Gestión de Pacientes</h1>
    <a href="add.php">Agregar Paciente</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha de Nacimiento</th>
            <th>Sexo</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($paciente = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $paciente['CODP']; ?></td>
                <td><?php echo $paciente['NOMBRE']; ?></td>
                <td><?php echo $paciente['FECHANAC']; ?></td>
                <td><?php echo $paciente['SEXO']; ?></td>
                <td><?php echo $paciente['CORREO']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $paciente['CODP']; ?>">Editar</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $paciente['CODP']; ?>)">Eliminar</a>
                    <a href="historial.php?id=<?php echo $paciente['CODP']; ?>">Historial</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="../index.php">Volver al Panel de Control</a>
</body></div>
</html>
