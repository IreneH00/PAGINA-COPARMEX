<?php
include 'conexion.php';


$input = json_decode(file_get_contents('php://input'), true);

$nombre = $input['name'];
$evento = $input['evento'];
$fechaInic = $input['fechaInic'];
$fechaFin = $input['fechaFin'];
$horaInic = $input['horaInic'];
$horaFin = $input['horaFin'];

$response = [];

if (empty($nombre) || empty($evento) || empty($fechaInic) || empty($fechaFin) || empty($horaInic) || empty($horaFin)) {
    $response['status'] = 'error';
    $response['message'] = 'Todos los campos son obligatorios.';
} else {
    $sql = "INSERT INTO agenda (nombre, evento, fechaInic, fechaFin, horaInic, horaFin) VALUES ('$nombre', '$evento', '$fechaInic', '$fechaFin', '$horaInic', '$horaFin')";

    if (mysqli_query($conex, $sql)) {
        $response['status'] = 'success';
        $response['message'] = 'Se guardó correctamente';
        $response['nombre'] = $nombre;
        $response['evento'] = $evento;
        $response['fechaInic'] = $fechaInic;
        $response['fechaFin'] = $fechaFin;
        $response['horaInic'] = $horaInic;
        $response['horaFin'] = $horaFin;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Intenta de nuevo: ' . mysqli_error($conex);
    }
}

// Cerrar la conexión
mysqli_close($conex);

// Devolver la respuesta en formato JSON
echo json_encode($response);
