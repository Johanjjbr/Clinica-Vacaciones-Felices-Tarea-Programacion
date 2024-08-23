<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole(1);

// Aquí va el contenido de la página para administradores
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Bienvenido, Administrador</h1>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
