<?php
session_start();
include('C:\xampp\htdocs\includes\function.php');

// Agregar la función readCSV si no está en function.php
function readCSV($csvFile) {
    $rows = [];
    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    return $rows;
}

// Verificar rol de administrador
checkRole(1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Ruta al archivo CSV de usuarios
    $csvFile = 'C:\xampp\htdocs\usuario\usuario.csv';

    // Leer todos los usuarios para encontrar el último ID
    $usuarios = readCSV($csvFile);

    // Verificar si el archivo está vacío
    if (count($usuarios) > 0) {
        // Obtener el último ID del último usuario
        $lastUser = end($usuarios);
        $id = $lastUser[0] + 1; // Incrementar el último ID en 1
    } else {
        // Si no hay usuarios, comenzamos con ID 1
        $id = 1;
    }

    // Abrir el archivo en modo de escritura para agregar un nuevo usuario
    $handle = fopen($csvFile, 'a');
    if ($handle !== FALSE) {
        fputcsv($handle, [$id, $username, $password, $role, $nombre, $email]);
        fclose($handle);
        header("Location: usuarios.php");
    } else {
        echo "Error al abrir el archivo.";
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
    <a href="./usuarios.php">Volver a la Lista de Usuarios</a>
</body>
</html>
