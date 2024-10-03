<?php
session_start();
include 'conexion.php';

$socio_id = $_POST['socio_id'] ?? $_GET['socio_id'] ?? null; 

if ($socio_id === null) {
    echo json_encode(['error' => 'ID de socio no proporcionado']);
    exit;
}


$abonosQuery = "SELECT fecha_pago AS fecha, monto, forma_pago, 'Abono' AS tipo, creado_por AS usuario FROM abonos WHERE socio_id = ?";
$stmtAbonos = $conex->prepare($abonosQuery);
$stmtAbonos->bind_param("i", $socio_id);
$stmtAbonos->execute();
$resultAbonos = $stmtAbonos->get_result();
$abonos = $resultAbonos->fetch_all(MYSQLI_ASSOC);


$condonacionesQuery = "SELECT fecha_condonacion AS fecha, monto_condonacion AS monto, 'NULL' AS forma_pago, 'Condonación' AS tipo, creado_por AS usuario FROM condonaciones WHERE socio_id = ?";
$stmtCondonaciones = $conex->prepare($condonacionesQuery);
$stmtCondonaciones->bind_param("i", $socio_id);
$stmtCondonaciones->execute();
$resultCondonaciones = $stmtCondonaciones->get_result();
$condonaciones = $resultCondonaciones->fetch_all(MYSQLI_ASSOC);


$historial = array_merge($abonos, $condonaciones);

$creado_por = $_SESSION['nombre'] ?? 'Desconocido';

foreach ($historial as &$transaccion) {
    $transaccion['creado_por'] = $creado_por;
    $transaccion['tipo'] = $transaccion['tipo'] ?? $transaccion['tipo_transaccion']; 
}

echo json_encode($historial);


?>
