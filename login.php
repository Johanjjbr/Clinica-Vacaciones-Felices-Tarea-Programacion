<?php
session_start();

// Ruta al archivo CSV de usuarios
$csvFile = 'C:\xampp\htdocs\usuario\usuario.csv';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userFound = false;

    // Abrir el archivo CSV
    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        // Leer cada línea del archivo CSV
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Verificar si el nombre de usuario coincide
            if ($data[1] == $username) {
                $userFound = true;
                // Verificar si la contraseña es correcta
                if ($password == $data[2]) {  // Comparación directa de contraseñas
                    // Iniciar la sesión del usuario
                    $_SESSION['ID'] = $data[0]; // ID del usuario
                    $_SESSION['ROLE_ID'] = $data[3]; // Rol del usuario
                    fclose($handle);
                    header("Location: index.php");
                    die();
                                        
                } else {
                    echo "Contraseña incorrecta.";
                    break;
                }
            }
        }
        fclose($handle);

        if (!$userFound) {
            echo "Usuario no encontrado.";
        }
    } else {
        echo "Error al abrir el archivo CSV.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="">
        <label>Usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>
