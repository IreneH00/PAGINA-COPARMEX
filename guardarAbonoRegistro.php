<?php
include 'conexion.php';

if (isset($_POST['id'], $_POST['totalAnualidad'], $_POST['porCobrar'], $_POST['monto'], $_POST['formaPago'], $_POST['fechaPago'])) {
    
    $registro_id = (int) $_POST['id']; 
    $total_anualidad = (float) $_POST['totalAnualidad'];
    $por_cobrar = (float) $_POST['porCobrar'];
    $monto = (float) $_POST['monto'];
    $forma_pago = $conex->real_escape_string($_POST['formaPago']);
    $fecha_pago = $conex->real_escape_string($_POST['fechaPago']);
    
   
    $query = "INSERT INTO abonos_eventos (registro_evento_id, total_anualidad, por_cobrar, monto, forma_pago, fecha_pago)
              VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conex->prepare($query)) {
        $stmt->bind_param('iddsss', $registro_id, $total_anualidad, $por_cobrar, $monto, $forma_pago, $fecha_pago);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar el abono.']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
    }
    
    $conex->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
