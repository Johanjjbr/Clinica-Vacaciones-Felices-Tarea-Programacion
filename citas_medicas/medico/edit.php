<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole(1);

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $turno = $_POST['turno'];
    $disponibilidad = $_POST['disponibilidad'];

    $sql = "UPDATE medicos SET NOMBRE='$nombre', ESPECIALIDAD='$especialidad', TURNO='$turno', DISPONIBILIDAD='$disponibilidad' WHERE CODM=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM medicos WHERE CODM=$id";
    $result = $conn->query($sql);
    $medico = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Médico</title>
</head>
<body>
    <h1>Editar Médico</h1>
    <form method="post" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $medico['NOMBRE']; ?>" required>
        <br>
        <label>Especialidad:</label>
        <input type="text" name="especialidad" value="<?php echo $medico['ESPECIALIDAD']; ?>" required>
        <br>
        <label>Turno:</label>
        <input type="text" name="turno" value="<?php echo $medico['TURNO']; ?>" required>
        <br>
        <label>Disponibilidad:</label>
        <input type="text" name="disponibilidad" value="<?php echo $medico['DISPONIBILIDAD']; ?>" required>
        <br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="medicos.php">Volver a la Lista de Médicos</a>
</body>
</html>
