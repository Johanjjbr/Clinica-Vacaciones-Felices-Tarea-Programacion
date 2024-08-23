<?php
session_start();
include('C:\xampp\htdocs\includes\function.php');


// Verificar rol de administrador
checkRole(1);

$id = $_GET['id'];

// Ruta al archivo CSV de usuarios
$csvFile = 'C:\xampp\htdocs\usuario\usuario.csv';

// Leer todos los usuarios
$usuarios = readCSV($csvFile);
$usuarioEditado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Abrir el archivo en modo de escritura para sobrescribir
    $handle = fopen($csvFile, 'w');

    if ($handle !== FALSE) {
        foreach ($usuarios as $usuario) {
            // Si es el usuario que estamos editando, cambiar sus datos
            if ($usuario[0] == $id) {
                $usuario[1] = $username;
                $usuario[2] = $pass;
                $usuario[3] = $nombre;
                $usuario[4] = $email;
                $usuario[5] = $role;
            }
            fputcsv($handle, $usuario);
        }
        fclose($handle);
        header("Location: usuarios.php");
    } else {
        echo "Error al abrir el archivo.";
    }
} else {
    foreach ($usuarios as $usuario) {
        if ($usuario[0] == $id) {
            $usuarioEditado = $usuario;
            break;
        }
    }
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
        <input type="text" name="username" value="<?php echo $usuarioEditado[1]; ?>" required>
        <br>
        <label>Contraseña:</label>
        <input type="text" name="pass" value="<?php echo $usuarioEditado[2]; ?>" required>
        <br>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuarioEditado[3]; ?>" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $usuarioEditado[4]; ?>" required>
        <br>
        <label>Rol:</label>
        <select name="role" required>
            <option value="1" <?php echo $usuarioEditado[5] == 1 ? 'selected' : ''; ?>>Administrador</option>
            <option value="2" <?php echo $usuarioEditado[5] == 2 ? 'selected' : ''; ?>>Médico</option>
            <option value="3" <?php echo $usuarioEditado[5] == 3 ? 'selected' : ''; ?>>Enfermero</option>
        </select>
        <br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="usuarios.php">Volver a la Lista de Usuarios</a>
</body>
</html>
