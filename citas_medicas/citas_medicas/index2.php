<?php
session_start();
include_once('C:\xampp\htdocs\citas_medicas\includes\db.php');
include_once('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
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
        <h1>Bienvenido al Panel de Control</h1>
        <p>Selecciona una opción del menú para comenzar.</p>
    </div>
</body>
</html>
