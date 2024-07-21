<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Manejar la creación de pacientes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $fecha_nac = $_POST['fecha_nac'];
    $sexo = $_POST['sexo'];
    $correo = $_POST['correo'];

    $query = "INSERT INTO pacientes (NOMBRE, FECHANAC, SEXO, CORREO) VALUES ('$nombre', '$fecha_nac', '$sexo', '$correo')";
    if (mysqli_query($conn, $query)) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agregar Paciente - Clínica Vacaciones Felices C.A.</title>
</head>
<body>
    <h1>Agregar Paciente</h1>
    <form method="POST" action="add.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="fecha_nac">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nac" required>
        <label for="sexo">Sexo:</label>
        <select name="sexo">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" required>
        <button type="submit">Agregar Paciente</button>
    </form>
    <a href="view.php">Volver a la Lista de Pacientes</a>
</body>
</html>
