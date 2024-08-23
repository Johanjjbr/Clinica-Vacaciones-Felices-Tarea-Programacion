<?php
session_start();
include('C:\xampp\htdocs\includes\function.php');
$citas = readCSV('C:\xampp\htdocs\cita\cita.csv');

// Verificar si el usuario ha iniciado sesión
/* if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit();
} */


// Leer las citas desde el archivo CSV
$citas = readCSV('C:\xampp\htdocs\cita\cita.csv');

// Obtener el rol del usuario
$user_role = $_SESSION['role_id'];

checkRole([1, 2]);

// Leer los pacientes y médicos (esto asume que también usas CSV para estos datos)
$pacientes = readCSV('C:\xampp\htdocs\citas_medicas\paciente\pasciente.csv');
$medicos = readCSV('C:\xampp\htdocs\citas_medicas\medico\medicos.csv');

// Combinar datos de citas con datos de pacientes y médicos
$combinedCitas = [];
foreach ($citas as $cita) {
    $paciente = array_filter($pacientes, function($p) use ($cita) {
        return $p['CODP'] == $cita['CODP'];
    });
    $medico = array_filter($medicos, function($m) use ($cita) {
        return $m['CODM'] == $cita['CODM'];
    });
    
    $paciente = reset($paciente);
    $medico = reset($medico);

    $combinedCitas[] = [
        'CODCITA' => $cita['CODCITA'],
        'PACIENTE' => $paciente['NOMBRE'],
        'MEDICO' => $medico['NOMBRE'],
        'FECHACITA' => $cita['FECHACITA'],
        'DIAGNOSTICO' => $cita['DIAGNOSTICO'],
        'HORACITA' => $cita['HORACITA'] // Nueva columna
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function confirmDelete(citaId) {
            var confirmation = confirm("¿Estás seguro de que deseas eliminar esta cita?");
            if (confirmation) {
                window.location.href = "./delete.php?id=" + citaId;
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
        <?php foreach ($combinedCitas as $cita): ?>
            <tr>
                <td><?php echo $cita['CODCITA']; ?></td>
                <td><?php echo $cita['PACIENTE']; ?></td>
                <td><?php echo $cita['MEDICO']; ?></td>
                <td><?php echo $cita['FECHACITA']; ?></td>
                <td><?php echo $cita['DIAGNOSTICO']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $cita['CODCITA']; ?>">Editar</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $cita['CODCITA']; ?>)">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../index.php">Volver al Panel de Control</a>
    </div>
</body>
</html>
