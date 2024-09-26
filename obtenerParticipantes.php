<?php
include 'conexion.php';

$id = $_GET['id'];

$query = "SELECT * FROM registro_eventos_socios WHERE id = $id";
$resultado = $conex->query($query);

if ($resultado->num_rows > 0) {
    $participante = $resultado->fetch_assoc();
    echo json_encode($participante);
} else {
    echo json_encode(['error' => 'Nombre o ponente no encontrado']);
}