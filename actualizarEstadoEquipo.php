<?php
include 'conexion.php';

$id = $_POST['id'];
$estado = $_POST['estado'];

$query = "UPDATE equipo SET Estado = ? WHERE id = ?";
$stmt = $conex->prepare($query);
$stmt->bind_param("si", $estado, $id);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

$stmt->close();
$conex->close();
?>
