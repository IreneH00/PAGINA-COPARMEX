<?php
header('Content-Type: application/json');
include 'conexion.php';

// Obtener categorías
$sqlCategorias = "SELECT id, nombre FROM categoria";
$resultCategorias = $conn->query($sqlCategorias);

$categorias = array();
while ($row = $resultCategorias->fetch_assoc()) {
    $categorias[] = $row;
}

// Obtener socios
$sqlSocios = "SELECT id, nombre FROM socio";
$resultSocios = $conn->query($sqlSocios);

$socios = array();
while ($row = $resultSocios->fetch_assoc()) {
    $socios[] = $row;
}


echo json_encode(array(
    'categorias' => $categorias,
    'socios' => $socios
));
?>
