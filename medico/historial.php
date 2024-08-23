<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener ID del medico desde la URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    // Si no hay ID en la URL, redirigir a la página de citas
    header("Location: view.php");
    exit();
}

// Obtener historial médico
$query = "SELECT citas.FECHACITA, citas.DIAGNOSTICO, pacientes.NOMBRE AS PACIENTE
          FROM citas
          JOIN pacientes ON citas.CODP = pacientes.CODP
          WHERE citas.CODM = $id
          ORDER BY citas.FECHACITA DESC";
$result = mysqli_query($conn, $query);

// Verificar si hay citas para el medico
if (!$result || mysqli_num_rows($result) == 0) {
    echo "No se encontraron citas para este médico.";
    exit();
}

// Obtener datos del medico
$queryMedico = "SELECT * FROM medicos WHERE CODM = $id";
$resultMedico = mysqli_query($conn, $queryMedico);
$medico = mysqli_fetch_assoc($resultMedico);

// Verificar si el médico existe
if (!$medico) {
    echo "Médico no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historial Médico - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include '../includes/menu2.php'; ?>
<div class="content">
    <h1>Historial Médico del Dr./Dra. <?php echo htmlspecialchars($medico['NOMBRE'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <h2>Citas Médicas</h2>
    <table border="1">
        <tr>
            <th>Fecha de Cita</th>
            <th>Diagnóstico</th>
            <th>Paciente</th>
        </tr>
        <?php while ($cita = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($cita['FECHACITA'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($cita['DIAGNOSTICO'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($cita['PACIENTE'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="view.php">Volver a la Lista de Médicos</a>
</div>
</body>
</html>
