<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de enfermero o administrador
checkRole(1);

$id = $_GET['id'];

// Verificar si la cita ya ocurrió
$query = "SELECT FECHACITA FROM citas WHERE CODCITA=$id";
$result = $conn->query($query);
$cita = $result->fetch_assoc();

if (new DateTime($cita['FECHACITA']) < new DateTime()) {
    echo "No se puede eliminar una cita que ya ocurrió.";
} else {
    $sql = "DELETE FROM citas WHERE CODCITA=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
