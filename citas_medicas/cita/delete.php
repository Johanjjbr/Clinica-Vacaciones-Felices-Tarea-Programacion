<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar rol de enfermero o administrador
checkRole([1, 2]);

// Obtener el ID de la cita
$id = intval($_GET['id']);

$query = "DELETE FROM citas WHERE CODCITA = $id";
if (mysqli_query($conn, $query)) {
    header("Location: view.php");
} else {
    echo "Error al eliminar la cita: " . mysqli_error($conn);
}
?>
