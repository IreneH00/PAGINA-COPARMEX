<?php
include 'conexion.php';

$query = "SELECT id, nombre FROM categoria";
$result = $conex->query($query);

$categorias = [];
while ($row = $result->fetch_assoc()) {
    $categorias[] = $row;
}

echo json_encode($categorias);
?>
