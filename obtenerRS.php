<?php
//OBTENER LA RAZON SOCIAL PARA EL FORM
include 'conexion.php';

$nombreComercial = $_GET['nombreComercial'];
$query = "SELECT razonSocial FROM socios WHERE nombreComercial = ?";
$stmt = $conex->prepare($query);
$stmt->bind_param("s", $nombreComercial);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['razonSocial' => $row['razonSocial']]);
} else {
    echo json_encode(['razonSocial' => null]);
}
?>
