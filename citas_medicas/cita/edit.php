<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de enfermero o administrador
checkRole(1);

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codp = $_POST['codp'];
    $codm = $_POST['codm'];
    $fechacita = $_POST['fechacita'];
    $diagnostico = $_POST['diagnostico'];

    // Validar disponibilidad del médico
    $query = "SELECT COUNT(*) as count FROM citas WHERE CODM=$codm AND FECHACITA='$fechacita' AND CODCITA != $id";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_assoc($result)['count'];

    if ($count > 0) {
        echo "El médico no está disponible en esa fecha.";
    } else {
        $sql = "UPDATE citas SET CODP='$codp', CODM='$codm', FECHACITA='$fechacita', DIAGNOSTICO='$diagnostico' WHERE CODCITA=$id";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: view.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    $sql = "SELECT * FROM citas WHERE CODCITA=$id";
    $result = $conn->query($sql);
    $cita = $result->fetch_assoc();
}

// Obtener pacientes y médicos para el formulario
$queryPacientes = "SELECT * FROM pacientes";
$resultPacientes = mysqli_query($conn, $queryPacientes);

$queryMedicos = "SELECT * FROM medicos";
$resultMedicos = mysqli_query($conn, $queryMedicos);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Cita Médica - Clínica Vacaciones Felices C.A.</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include '../includes/menu2.php'; ?>

   <div class="content">
   <h1>Editar Cita Médica</h1>
    <form method="post" action="">
        <label>Paciente:</label>
        <select name="codp" required>
            <?php while ($paciente = mysqli_fetch_assoc($resultPacientes)): ?>
                <option value="<?php echo $paciente['CODP']; ?>" <?php echo ($paciente['CODP'] == $cita['CODP']) ? 'selected' : ''; ?>>
                    <?php echo $paciente['NOMBRE']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>
        <label>Médico:</label>
        <select name="codm" required>
            <?php while ($medico = mysqli_fetch_assoc($resultMedicos)): ?>
                <option value="<?php echo $medico['CODM']; ?>" <?php echo ($medico['CODM'] == $cita['CODM']) ? 'selected' : ''; ?>>
                    <?php echo $medico['NOMBRE']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br>
        <label>Fecha de Cita:</label>
        <input type="datetime-local" name="fechacita" value="<?php echo $cita['FECHACITA']; ?>" required>
        <br>
        <label>Diagnóstico:</label>
        <textarea name="diagnostico"><?php echo $cita['DIAGNOSTICO']; ?></textarea>
        <br>
        <input type="submit" value="Actualizar Cita">
    </form>
    <a href="view.php">Volver a la Lista de Citas Médicas</a>
   </div>
</body>
</html>
