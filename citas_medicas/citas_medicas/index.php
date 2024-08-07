<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el rol del usuario
$user_role = $_SESSION['role_id'];

// Obtener la próxima cita
$next_cita_date = null;
$query = "SELECT FECHACITA FROM citas ORDER BY FECHACITA ASC LIMIT 1";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $next_cita = mysqli_fetch_assoc($result);
    $next_cita_date = $next_cita['FECHACITA'];
}

checkRole([1, 2]);

// Obtener todos los pacientes
$query_pacientes = "SELECT * FROM pacientes";
$result_pacientes = mysqli_query($conn, $query_pacientes);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
      
    </style>
</head>
<body>
<?php include './includes/menu.php'; ?>

<div class="content"><h1>Pagina por trabajar</h1>

<h1>Se piensan poner graficos</h1>

<h3>Buscar tipos de graficos</h3>
</div>
</body>
</html>
