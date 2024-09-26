<?php
include 'conexion.php';

$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT s.id, s.fecha, c.nombre AS categoria, so.nombreComercial AS socio, s.nombre, s.costo, s.comentario
          FROM servicios s
          JOIN categoria c ON s.categoria = c.id
          JOIN socios so ON s.socio = so.id
          LIMIT $start, $limit";

$ejecutar = $conex->query($query);

$datos = [];
while ($result = $ejecutar->fetch_array()) {
    $datos[] = $result;
}


$totalQuery = "SELECT COUNT(*) AS total FROM servicios";
$totalResult = $conex->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$total = $totalRow['total'];
$totalPages = ceil($total / $limit);

$response = [
    'datos' => $datos,
    'totalPages' => $totalPages
];

echo json_encode($response);
?>
