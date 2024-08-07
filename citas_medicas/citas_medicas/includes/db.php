<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica_vacaciones_felices";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
