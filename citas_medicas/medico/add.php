<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole(1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $turno = $_POST['turno'];
    $disponibilidad = $_POST['disponibilidad'];

    $sql = "INSERT INTO medicos (NOMBRE, ESPECIALIDAD, TURNO, DISPONIBILIDAD) VALUES ('$nombre', '$especialidad', '$turno', '$disponibilidad')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agregar Médico</title>
</head>
<body>
    <h1>Agregar Médico</h1>
    <form method="post" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Especialidad:</label>
        <input type="text" name="especialidad" required>
        <br>
        <label>Turno:</label>
        <input type="text" name="turno" required>
        <br>
        <label>Disponibilidad:</label>
        <input type="text" name="disponibilidad" required>
        <br>
        <input type="submit" value="Agregar">
    </form>
    <a href="view.php">Volver a la Lista de Médicos</a>
</body>
</html>
