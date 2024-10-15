<?php
include 'conexion.php'; 
header('Content-Type: application/json');


$categoria_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($categoria_id) {
    
    $query = "SELECT nombre FROM categoria WHERE id = ?";
    $stmt = $conex->prepare($query);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'nombre' => $row['nombre']]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Categoría no encontrada.']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID de categoría no válido.']);
}

$conex->close();
?>
