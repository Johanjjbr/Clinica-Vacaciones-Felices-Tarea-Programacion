<?php
function checkRole($required_roles) {
    // Verificar si el usuario tiene una sesión activa y un rol asignado
    if (!isset($_SESSION['ID'])) {
        // Si no tiene rol asignado, redirigir al usuario a la página de inicio de sesión
        header("Location: ../login.php");
        exit();
    }

    // Obtener el rol del usuario desde la sesión
    $user_role = $_SESSION['ID'];

    // Si $required_roles es un entero, convertirlo en un array
    if (!is_array($required_roles)) {
        $required_roles = [$required_roles];
    }

    // Verificar si el rol del usuario está dentro de los roles permitidos
    if (!in_array($user_role, $required_roles)) {
        // Si no está permitido, mostrar un mensaje y detener la ejecución
        echo "No tienes permiso para acceder a esta página.";
        exit();
    }
}

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
?>
