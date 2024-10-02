<?php
include 'conexion.php';

if (isset($_POST['id'], $_POST['totalAnualidad'], $_POST['porCondonar'], $_POST['fechaCondonacion'], $_POST['tipoCondonacion'], $_POST['montoCondonacion'])) {
    
    $registro_id = (int) $_POST['id']; 
    $total_anualidad = (float) $_POST['totalAnualidad'];
    $por_condonar = (float) $_POST['porCondonar'];
    $fecha_condonacion = $conex->real_escape_string($_POST['fechaCondonacion']);
    $tipo = $conex->real_escape_string($_POST['tipoCondonacion']);
    $monto_condonacion = (float) $_POST['montoCondonacion'];

    
    $query = "INSERT INTO condonaciones_eventos (registro_evento_id, total_anualidad, por_condonar, fecha_condonacion, tipo, monto_condonacion)
              VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conex->prepare($query)) {
        $stmt->bind_param('iddsss', $registro_id, $total_anualidad, $por_condonar, $fecha_condonacion, $tipo, $monto_condonacion);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar la condonación.']);
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
