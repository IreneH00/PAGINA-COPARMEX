<?php
include 'conexion.php';

// Evitar cualquier salida previa
ob_start();

$id = $_GET['id'];

if (!isset($id)) {
    echo json_encode(['error' => 'ID no proporcionado']);
    exit();
}

// Consulta mejorada con verificación de errores
$query = "SELECT s.id, s.fecha, c.nombre AS categoria, so.nombreComercial AS socio, s.nombre, s.costo, s.comentario
          FROM servicios s
          JOIN categoria c ON s.categoria = c.id
          JOIN socios so ON s.socio = so.id
          WHERE s.id = ?
          ORDER BY s.id DESC";

if ($stmt = $conex->prepare($query)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $servicio = $resultado->fetch_assoc();
        echo json_encode($servicio);
    } else {
        echo json_encode(['error' => 'Servicio no encontrado']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'Error en la consulta SQL']);
}

// Limpiar cualquier salida previa para asegurar que solo se envíe JSON
ob_end_flush();
?>
