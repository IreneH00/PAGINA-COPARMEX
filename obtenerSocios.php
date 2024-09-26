<?php
include 'conexion.php';

$query = "SELECT id, nombreComercial FROM socios";
$result = $conex->query($query);

$socios = [];
while ($row = $result->fetch_assoc()) {
    $socios[] = $row;
}

echo json_encode($socios);
?>
