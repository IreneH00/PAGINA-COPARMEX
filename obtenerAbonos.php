<?php
include 'conexion.php';

$socio_id = $_GET['socio_id']; 
$sql = "SELECT por_cobrar FROM abonos WHERE socio_id = ? ORDER BY id DESC LIMIT 1";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $socio_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $porCobrar = $row['por_cobrar'];
} else {
    $porCobrar = 0;
}

$stmt->close();
$conex->close();

echo json_encode(['porCobrar' => $porCobrar]);
?>
