<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole(1);

$id = $_GET['id'];

// Verificar si el paciente ya ha sido atendido
$sql = "SELECT COUNT(*) as count FROM citas WHERE CODP=$id";
$result = $conn->query($sql);
$count = $result->fetch_assoc()['count'];

if ($count > 0) {
    echo "No se puede eliminar un paciente que ya ha sido atendido.";
} else {
    $sql = "DELETE FROM pacientes WHERE CODP=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
