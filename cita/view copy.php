<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener todas las citas
$query = "SELECT citas.CODCITA, pacientes.NOMBRE as PACIENTE, medicos.NOMBRE as MEDICO, citas.FECHACITA, citas.DIAGNOSTICO 
          FROM citas 
          JOIN pacientes ON citas.CODP = pacientes.CODP 
          JOIN medicos ON citas.CODM = medicos.CODM";
$result = mysqli_query($conn, $query);


// Obtener el rol del usuario
$user_role = $_SESSION['role_id'];

checkRole([1, 2]);

// Obtener todos los pacientes
$query_pacientes = "SELECT * FROM pacientes";
$result_pacientes = mysqli_query($conn, $query_pacientes);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control - Clínica Vacaciones Felices C.A.</title>
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
    <h1>Gestión de Citas Médicas</h1>
    <a href="add.php">Agregar Cita Médica</a>
    <table border="1">
        <tr>
            <th>ID Cita</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Fecha de Cita</th>
            <th>Diagnóstico</th>
            <th>Acciones</th>
        </tr>
        <?php while ($cita = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $cita['CODCITA']; ?></td>
                <td><?php echo $cita['PACIENTE']; ?></td>
                <td><?php echo $cita['MEDICO']; ?></td>
                <td><?php echo $cita['FECHACITA']; ?></td>
                <td><?php echo $cita['DIAGNOSTICO']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $cita['CODCITA']; ?>">Editar</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['CODCITA']; ?>)">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="../index.php">Volver al Panel de Control</a>
    </div>
</body>
</html>
