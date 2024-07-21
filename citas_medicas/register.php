<?php
session_start();
include('C:\xampp\htdocs\citas_medicas\includes\db.php');
include('C:\xampp\htdocs\citas_medicas\includes\function.php');

// Verificar rol de administrador
// Ensure the admin role is verified if required

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role']; // Change 'rols' to 'role'
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (USERNAME, PASSWORD, ROLE, NOMBRE, EMAIL) VALUES ('$username', '$password', '$role', '$nombre', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: usuario/usuarios.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Usuario</title>
</head>
<body>
    <h1>Registrar Usuario</h1>
    <form method="post" action="">
        <label>Nombre de Usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Rol:</label>
        <select name="role" required>
            <option value="1">Administrador</option>
            <option value="2">Médico</option>
            <option value="3">Enfermero</option>
        </select>
        <br>
        <input type="submit" value="Registrar">
    </form>
    <a href="usuarios.php">Volver a la Lista de Usuarios</a>
</body>
</html>
