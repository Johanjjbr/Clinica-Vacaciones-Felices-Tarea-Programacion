<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
checkRole(1);

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE usuarios SET USERNAME='$username', NOMBRE='$nombre', EMAIL='$email', ROLE='$role' WHERE ID=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: usuarios.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM usuarios WHERE ID=$id";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="post" action="">
        <label>Nombre de Usuario:</label>
        <input type="text" name="username" value="<?php echo $usuario['USERNAME']; ?>" required>
        <br>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuario['NOMBRE']; ?>" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $usuario['EMAIL']; ?>" required>
        <br>
        <label>Rol:</label>
        <select name="role" required>
            <option value="1" <?php echo $usuario['ROLE'] == 1 ? 'selected' : ''; ?>>Administrador</option>
            <option value="2" <?php echo $usuario['ROLE'] == 2 ? 'selected' : ''; ?>>Médico</option>
            <option value="3" <?php echo $usuario['ROLE'] == 3 ? 'selected' : ''; ?>>Enfermero</option>
        </select>
        <br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="usuarios.php">Volver a la Lista de Usuarios</a>
</body>
</html>
