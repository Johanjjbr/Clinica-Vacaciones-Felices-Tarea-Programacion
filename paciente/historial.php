<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener ID del paciente desde la URL
$id = $_GET['id'];

// Obtener historial médico
$query = "SELECT citas.FECHACITA, citas.DIAGNOSTICO, medicos.NOMBRE AS MEDICO
          FROM citas
          JOIN medicos ON citas.CODM = medicos.CODM
          WHERE citas.CODP = $id
          ORDER BY citas.FECHACITA DESC";
$result = mysqli_query($conn, $query);

// Obtener datos del paciente
$queryPaciente = "SELECT * FROM pacientes WHERE CODP = $id";
$resultPaciente = mysqli_query($conn, $queryPaciente);
$paciente = mysqli_fetch_assoc($resultPaciente);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historial Médico - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include '../includes/menu2.php'; ?>
<div class="content"><h1>Historial Médico de <?php echo $paciente['NOMBRE']; ?></h1>
    <h2>Citas Médicas</h2>
    <table border="1">
        <tr>
            <th>Fecha de Cita</th>
            <th>Diagnóstico</th>
            <th>Médico</th>
        </tr>
        <?php while ($cita = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $cita['FECHACITA']; ?></td>
                <td><?php echo $cita['DIAGNOSTICO']; ?></td>
                <td><?php echo $cita['MEDICO']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="view.php">Volver a la Lista de Pacientes</a></div>
    
</body>
</html>
