<?php
session_start();
include('C:\xampp\htdocs\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

// Obtener el rol del usuario
$user_role = $_SESSION['ID'];

// Obtener la próxima cita
$citas = readCSV('C:\xampp\htdocs\cita\cita.csv');
$next_cita_date = null;

if (count($citas) > 0) {
    usort($citas, function($a, $b) {
        return strtotime($a[3]) - strtotime($b[3]); // Ordenar por fecha de cita (FECHACITA)
    });
    $next_cita_date = $citas[0][3]; // FECHACITA está en la columna 3
}

checkRole([1, 2]);

// Obtener todos los pacientes
$pacientes = readCSV('C:\xampp\htdocs\paciente\pasciente.csv');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include './includes/menu.php'; ?>

<div class="content">
    <h1>Panel de Control - Clínica Vacaciones Felices C.A.</h1>
    <h3>Próxima cita: <?php echo $next_cita_date ? $next_cita_date : 'No hay citas programadas'; ?></h3>

    <h2>Pacientes</h2>
    <table border="1">
        <tr>
            <th>ID Paciente</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Sexo</th>
        </tr>
        <?php foreach ($pacientes as $paciente): ?>
            <tr>
                <td><?php echo $paciente[0]; ?></td> <!-- CODP -->
                <td><?php echo $paciente[1]; ?></td> <!-- NOMBRE -->
                <td><?php echo $paciente[2]; ?></td> <!-- EDAD -->
                <td><?php echo $paciente[3]; ?></td> <!-- SEXO -->
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
