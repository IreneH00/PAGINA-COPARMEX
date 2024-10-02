<?php
header('Content-Type: application/json');
include 'conexion.php';

if (!$conex) {
    error_log('Error de conexión a la base de datos: ' . mysqli_connect_error());
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos.']);
    exit;
}

session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    
    $comentarioDireccion = $_POST['comentarioDireccion'] ?? null;
    $creado_por = $_SESSION['nombre'] ?? 'Desconocido'; 


    
    if (empty($id) || empty($comentarioDireccion)) {
        error_log('Error: Campos vacíos - id: ' . $id . ', comentario: ' . $comentarioDireccion);
        echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos.']);
        exit;
    }

 
    $query = "INSERT INTO comentarios_registros (registro_id, comentario, creado_por) VALUES (?, ?, ?)";
    $stmt = $conex->prepare($query);

    if ($stmt) {
        $stmt->bind_param('iss', $id, $comentarioDireccion, $creado_por);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al insertar el comentario.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta.']);
    }

    $conex->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud inválido.']);
}
?>
