<?php
include 'conexion.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'single';

if ($type == 'all') {
    
    $query = "SELECT * FROM ponentes";
    $resultado = $conex->query($query);
    
    if ($resultado->num_rows > 0) {
        $ponentes = [];
        while ($row = $resultado->fetch_assoc()) {
            $ponentes[] = $row;
        }
        echo json_encode($ponentes);
    } else {
        echo json_encode([]);
    }
} else {
   
    if (isset($_GET['id'])) {
        $id = $conex->real_escape_string($_GET['id']);
        $query = "SELECT * FROM ponentes WHERE id = $id";
        $resultado = $conex->query($query);

        if ($resultado->num_rows > 0) {
            $ponente = $resultado->fetch_assoc();
            echo json_encode($ponente);
        } else {
            echo json_encode(['error' => 'Ponente no encontrado']);
        }
    } else {
        echo json_encode(['error' => 'ID no proporcionado']);
    }
}
?>