<?php
include 'conexion.php';

$query = "SELECT id, nombre FROM productos";
$result = $conex->query($query);

$productos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}


header('Content-Type: application/json');
echo json_encode($productos);
?>
