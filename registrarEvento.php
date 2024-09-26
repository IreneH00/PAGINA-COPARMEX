<?php
include 'conexion.php';

if ($conex->connect_error) {
    die("Error de conexión: " . $conex->connect_error);
}

$nombre_evento = $_POST['nombre_evento'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$modo = $_POST['modo'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$ubicacion = $_POST['ubicacion'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$hora = $_POST['hora'] ?? '';
$gratis = isset($_POST['gratis']) ? 1 : 0; // Manejar checkbox
$precio_socio = $_POST['precio_socio'] ?? null;
$precio_general = $_POST['precio_general'] ?? null;
$precio_estudiante = $_POST['precio_estudiante'] ?? null;
$precio_prospecto = $_POST['precio_prospecto'] ?? null;
$precio_cortesia = $_POST['precio_cortesia'] ?? null;
$precio_no_activo = $_POST['precio_no_activo'] ?? null;
$ponente = $_POST['ponente'] ?? '';
$link_zoom = $_POST['link_zoom'] ?? '';
$comentario = $_POST['comentario'] ?? '';
$archivo = $_FILES['archivo']['name'] ?? ''; // Cambiado a FILES

$fecha = date('Y-m-d', strtotime($fecha));
$hora = date('H:i:s', strtotime($hora));

if (empty($nombre_evento) || empty($tipo) || empty($modo) || empty($categoria) || empty($ubicacion) || empty($fecha) || empty($hora) || empty($ponente) || empty($link_zoom) || empty($comentario) || empty($archivo)) {
    echo "Todos los campos son obligatorios.";
} else {
    $stmt = $conex->prepare("INSERT INTO eventos (nombre_evento, tipo, modo, categoria, ubicacion, fecha, hora, gratis, precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo, ponente, link_zoom, comentario, archivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Error en prepare: ' . $conex->error);
    }

    $stmt->bind_param("ssssssssssssssssss", $nombre_evento, $tipo, $modo, $categoria, $ubicacion, $fecha, $hora, $gratis, $precio_socio, $precio_general, $precio_estudiante, $precio_prospecto, $precio_cortesia, $precio_no_activo, $ponente, $link_zoom, $comentario, $archivo);

    if ($stmt->execute()) {
        echo "Datos del evento guardados correctamente.";
    } else {
        echo "Error en la ejecución: " . $stmt->error;
    }

    $stmt->close();
}

$conex->close();
?>
