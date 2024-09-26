<?php
include 'conexion.php';

$id = $_GET['id'];

$query = "SELECT * FROM eventos WHERE id = $id";
$resultado = $conex->query($query);

if ($resultado->num_rows > 0) {
    $evento = $resultado->fetch_assoc();
    echo json_encode($evento);
} else {
    echo json_encode(['error' => 'Evento no encontrado']);
}
