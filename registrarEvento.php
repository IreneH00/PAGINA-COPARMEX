<?php
// Incluir archivo de conexión
include 'conexion.php';

// Recibir datos enviados desde JavaScript
$nombre_evento = $_POST['nombre_evento'];
$tipo = $_POST['tipo'];
$modo = $_POST['modo'];
$categoria = $_POST['categoria'];
$ubicacion = $_POST['ubicacion'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$gratis = $_POST['gratis'];
$precio_socio = $_POST['precio_socio'];
$precio_general = $_POST['precio_general'];
$precio_estudiante = $_POST['precio_estudiante'];
$precio_prospecto = $_POST['precio_prospecto'];
$precio_cortesia = $_POST['precio_cortesia'];
$precio_no_activo = $_POST['precio_no_activo'];
$ponente = $_POST['ponente'];
$link_zoom = $_POST['link_zoom'];
$comentario = $_POST['comentario'];
$archivo = $_POST['archivo'];

// Preparar y ejecutar la consulta
$stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, tipo, modo, categoria, ubicacion, fecha, hora, gratis, precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo, ponente, link_zoom, comentario, archivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Error en la preparación: " . $conn->error);
}

$stmt->bind_param("sssssssssssssssss", $nombre_evento, $tipo, $modo, $categoria, $ubicacion, $fecha, $hora, $gratis, $precio_socio, $precio_general, $precio_estudiante, $precio_prospecto, $precio_cortesia, $precio_no_activo, $ponente, $link_zoom, $comentario, $archivo);

if ($stmt->execute()) {
    echo "Evento guardado exitosamente.";
} else {
    echo "Error al guardar el evento: " . $stmt->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
