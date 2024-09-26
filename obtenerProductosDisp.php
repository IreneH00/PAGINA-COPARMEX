<?php
// OBTENER LOS PRODUCTOS DISPONIBLES PARA RETIRAR DEL STOCK
header('Content-Type: application/json');


include 'conexion.php';


if ($conex->connect_error) {
    die('Conexión fallida: ' . $conex->connect_error);
}


$sql = "SELECT id, nombre FROM productos WHERE cantidad_total > 0";
$result = $conex->query($sql);


$productos = array();
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}


$conex->close();


echo json_encode($productos);
?>
