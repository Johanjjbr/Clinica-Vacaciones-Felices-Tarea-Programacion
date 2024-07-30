<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole(1);

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $fecha_nac = $_POST['fecha_nac'];
    $sexo = $_POST['sexo'];
    $correo = $_POST['correo'];

    $sql = "UPDATE pacientes SET NOMBRE='$nombre', FECHANAC='$fecha_nac', SEXO='$sexo', CORREO='$correo' WHERE CODP=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM pacientes WHERE CODP=$id";
    $result = $conn->query($sql);
    $paciente = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include '../includes/menu2.php'; ?>

<div class="content">
<div class="content">
   <h1>Editar Paciente</h1>
    <form method="post" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $paciente['NOMBRE']; ?>" required>
        <br>
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nac" value="<?php echo $paciente['FECHANAC']; ?>" required>
        <br>
        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="M" <?php if($paciente['SEXO'] == 'M') echo 'selected'; ?>>Masculino</option>
            <option value="F" <?php if($paciente['SEXO'] == 'F') echo 'selected'; ?>>Femenino</option>
        </select>
        <br>
        <label>Correo:</label>
        <input type="email" name="correo" value="<?php echo $paciente['CORREO']; ?>" required>
        <br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="view.php">Volver a la Lista de Pacientes</a>
   </div>
</div>
</body>
</html>
