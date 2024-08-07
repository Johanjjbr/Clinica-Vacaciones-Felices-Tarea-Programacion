<?php
function checkRole($required_roles) {
    if (!isset($_SESSION['role_id'])) {
        header("Location: ../login.php");
        exit();
    }

    $user_role = $_SESSION['role_id'];

    // Convertir a array si $required_roles es un entero
    if (!is_array($required_roles)) {
        $required_roles = [$required_roles];
    }

    // Verificar si el rol del usuario está en el array de roles permitidos
    if (!in_array($user_role, $required_roles)) {
        echo "No tienes permiso para acceder a esta página.";
        exit();
    }
}
?>
