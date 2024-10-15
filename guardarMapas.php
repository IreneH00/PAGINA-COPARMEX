<?php
include 'conexion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($conex->connect_error) {
    die("Conexión fallida: " . $conex->connect_error);
}


$data = json_decode(file_get_contents('php://input'), true);


if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'No se recibieron datos JSON.']);
    exit;
}


$categoria_id = isset($data['categoria_id']) ? $data['categoria_id'] : null;
$num_mesas = isset($data['num_mesas']) ? $data['num_mesas'] : null;
$asientos_por_mesa = isset($data['asientos_por_mesa']) ? $data['asientos_por_mesa'] : null;
$asientos_mesa_principal = isset($data['asientos_mesa_principal']) ? $data['asientos_mesa_principal'] : null;
$detalles = isset($data['detalles']) ? $data['detalles'] : null;


if ($categoria_id === null || $num_mesas === null || $asientos_por_mesa === null || $asientos_mesa_principal === null || $detalles === null) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos.']);
    exit;
}


$sql = "INSERT INTO mapa_asientos (categoria_id, num_mesas, asientos_por_mesa, asientos_mesa_principal, detalles) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conex->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Error en la preparación de la consulta: ' . $conex->error]);
    exit;
}

$stmt->bind_param("iiiss", $categoria_id, $num_mesas, $asientos_por_mesa, $asientos_mesa_principal, $detalles);


if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conex->error]);
}

$stmt->close();
$conex->close();
?>
