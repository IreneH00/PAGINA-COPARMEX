<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $id = $_POST['id'];
    $nombre_evento = $_POST['nombre_evento'];
    $ubicacion = $_POST['ubicacion'];
    $ponente = $_POST['ponente'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $precio_socio = $_POST['precio_socio'];
    $precio_general = $_POST['precio_general'];
    $precio_estudiante = $_POST['precio_estudiante'];
    $precio_prospecto = $_POST['precio_prospecto'];
    $precio_cortesia = $_POST['precio_cortesia'];
    $precio_no_activo = $_POST['precio_no_activo'];

    $stmt = $conex->prepare("UPDATE eventos SET nombre_evento = ?, ubicacion = ?, ponente = ?,fecha = ?, hora = ?, precio_socio = ?, precio_general = ?, precio_estudiante = ?, precio_prospecto = ?, precio_cortesia = ?, precio_no_activo = ? WHERE id = ?");
    $stmt->bind_param("sssssssssssi", $nombre_evento, $ubicacion, $ponente, $fecha, $hora, $precio_socio, $precio_general, $precio_estudiante, $precio_prospecto, $precio_cortesia, $precio_no_activo, $id);

    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'Evento actualizado correctamente.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al actualizar el evento: ' . $stmt->error
        ];
    }

    $stmt->close();
} else {
    $response = [
        'status' => 'error',
        'message' => 'Método de solicitud no válido.'
    ];
}

echo json_encode($response);
