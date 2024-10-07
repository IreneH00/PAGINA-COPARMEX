<?php
session_start();
include 'conexion.php';


$registro_evento_id = $_POST['registro_evento_id'] ?? $_GET['registro_evento_id'] ?? null; 

if ($registro_evento_id === null) {
    echo json_encode(['error' => 'ID de evento no proporcionado']);
    exit;
}


$abonosQuery = "SELECT id, fecha_pago AS fecha, monto, forma_pago, 'Abono' AS tipo, creado_por AS usuario 
                FROM abonos_eventos 
                WHERE registro_evento_id = ?";
$stmtAbonos = $conex->prepare($abonosQuery);
$stmtAbonos->bind_param("i", $registro_evento_id);
$stmtAbonos->execute();
$resultAbonos = $stmtAbonos->get_result();
$abonos = $resultAbonos->fetch_all(MYSQLI_ASSOC);

$condonacionesQuery = "SELECT id, fecha_condonacion AS fecha, monto_condonacion AS monto, 'NULL' AS forma_pago, 'Condonación' AS tipo, creado_por AS usuario 
                       FROM condonaciones_eventos 
                       WHERE registro_evento_id = ?";
$stmtCondonaciones = $conex->prepare($condonacionesQuery);
$stmtCondonaciones->bind_param("i", $registro_evento_id);
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
