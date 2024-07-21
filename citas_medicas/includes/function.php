<?php
function checkRole($required_role) {
    if (!isset($_SESSION['role_id'])) {
        header("Location: ../login.php");
        exit();
    }

    $user_role = $_SESSION['role_id'];
    
    if ($user_role != $required_role) {
        echo "No tienes permiso para acceder a esta página.";
        exit();
    }
}
?>
