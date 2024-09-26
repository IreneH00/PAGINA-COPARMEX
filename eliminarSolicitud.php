<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    
    if ($id > 0) {
        $query = "DELETE FROM solicitudes WHERE id = ?";
        $stmt = $conex->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('i', $id);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Error en la preparación de la consulta.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido.']);
}

$conex->close();
?>
