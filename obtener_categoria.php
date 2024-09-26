<?php
include 'conexion.php';

$id = $_GET['id'];

$query = "SELECT * FROM categoria WHERE id = $id";
$resultado = $conex->query($query);

if ($resultado->num_rows > 0) {
    $categoria = $resultado->fetch_assoc();
    echo json_encode($categoria);
} else {
    echo json_encode(['error' => 'Nombre de la categorira no encontrado']);
}