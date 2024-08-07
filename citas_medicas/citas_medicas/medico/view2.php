<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
checkRole([1, 2]);

// Obtener todos los médicos
$query = "SELECT * FROM medicos";
$result = mysqli_query($conn, $query);
?>
<h1>Gestión de Médicos</h1>
<a href="add.php">Agregar Médico</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Especialidad</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    <?php while ($medico = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $medico['CODM']; ?></td>
            <td><?php echo $medico['NOMBRE']; ?></td>
            <td><?php echo $medico['ESPECIALIDAD']; ?></td>
            <td><?php echo $medico['CORREO']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $medico['CODM']; ?>">Editar</a>
                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $medico['CODM']; ?>)">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<script>
    function confirmDelete(medicoId) {
        var confirmation = confirm("¿Estás seguro de que deseas eliminar este Médico?");
        if (confirmation) {
            window.location.href = "delete.php?id=" + medicoId;
        }
    }
</script>
