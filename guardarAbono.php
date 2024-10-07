<?php
session_start(); 
include 'conexion.php';

if (isset($_POST['id'], $_POST['totalAnualidad'], $_POST['porCobrar'], $_POST['monto'], $_POST['formaPago'], $_POST['fechaPago'])) {

    $socio_id = (int) $_POST['id'];
    $total_anualidad = (float) $_POST['totalAnualidad'];
    $por_cobrar = (float) $_POST['porCobrar'];
    $monto = (float) $_POST['monto'];
    $forma_pago = $conex->real_escape_string($_POST['formaPago']);
    $fecha_pago = $conex->real_escape_string($_POST['fechaPago']);
    
    $creado_por = $_SESSION['nombre'] ?? 'Desconocido'; 

    $query = "INSERT INTO abonos (socio_id, total_anualidad, por_cobrar, monto, forma_pago, fecha_pago, creado_por)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conex->prepare($query)) {
        
        $stmt->bind_param('idddsss', $socio_id, $total_anualidad, $por_cobrar, $monto, $forma_pago, $fecha_pago, $creado_por);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar el abono. ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conex->error]);
    }

    $conex->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
