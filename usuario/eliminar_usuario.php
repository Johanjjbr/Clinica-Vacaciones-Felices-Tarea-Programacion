<?php
session_start();
include('C:\xampp\htdocs\includes\function.php');

// Verificar rol de administrador
checkRole(1);


$id = $_GET['id'];
$csvFile = 'C:\xampp\htdocs\usuario\usuario.csv';

// Leer el archivo CSV
$rows = readCSV($csvFile);

// Filtrar los usuarios para eliminar el que coincide con el ID
$filteredRows = array_filter($rows, function($row) use ($id) {
    return $row[0] != $id;
});

// Reescribir el archivo CSV sin el usuario eliminado
$handle = fopen($csvFile, 'w');
foreach ($filteredRows as $row) {
    fputcsv($handle, $row);
}
fclose($handle);

// Redirigir a la lista de usuarios
header("Location: usuarios.php");
exit();
?>
