<?php
include_once 'conexion.php';  


$data = json_decode(file_get_contents('php://input'), true);

if (empty($data)) {
    echo "No se recibieron datos";
    exit;
}

if (!isset($data['evento'], $data['nombre'], $data['usuario'], $data['empresa'], $data['mesa'], $data['asiento'], $data['estado'])) {
    echo "Datos incompletos";
    exit;
}

$evento = $data['evento'];
$nombre = $data['nombre'];
$usuario = $data['usuario'];
$empresa = $data['empresa'];
$mesa = $data['mesa'];
$asiento = $data['asiento'];
$estado = $data['estado'];



$sql = "INSERT INTO lista (evento, nombre, usuario, empresa, mesa, asiento, estado) 
        VALUES ('$evento', '$nombre', '$usuario', '$empresa', $mesa, $asiento, '$estado')";

if ($conex->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conex->error;
}


$conex->close();
?>

