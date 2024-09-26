<?php
include 'conexion.php'; 


$fecha = $_POST['fecha'];
$categoria = $_POST['categoria'];
$socio = $_POST['socio'];
$nombre = $_POST['nombre'];
$costo = $_POST['costo'];
$comentario = $_POST['comentario'];


$query = "INSERT INTO servicios (fecha, categoria, socio, nombre, costo, comentario) VALUES (?, ?, ?, ?, ?, ?)";


if ($stmt = $conex->prepare($query)) {
    $stmt->bind_param("ssssds", $fecha, $categoria, $socio, $nombre, $costo, $comentario);
    
    if ($stmt->execute()) {
        echo "Servicio guardado correctamente.";
    } else {
        echo "Error al guardar el servicio: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conex->error;
}

$conex->close();
?>
