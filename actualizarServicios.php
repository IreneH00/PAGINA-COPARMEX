<?php
include 'conexion.php';

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$categoria = $_POST['categoria'];
$socio = $_POST['socio'];
$nombre = $_POST['nombre'];
$costo = $_POST['costo'];
$comentario = $_POST['comentario'];

$query = "UPDATE servicios SET fecha=?, categoria=?, socio=?, nombre=?, costo=?, comentario=? WHERE id=?";
$stmt = $conex->prepare($query);
$stmt->bind_param('ssssssi', $fecha, $categoria, $socio, $nombre, $costo, $comentario, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Servicio actualizado con éxito']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el servicio']);
}

$stmt->close();
$conex->close();
?>
