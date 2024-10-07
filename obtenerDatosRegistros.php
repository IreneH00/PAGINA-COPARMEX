<?php

include 'conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    
    $query = "SELECT r.id, r.nombre_evento, r.nombre, r.telefono, r.correo, r.pagado, e.precio_socio 
              FROM registro_eventos_socios r
              JOIN eventos e ON r.nombre_evento = e.nombre_evento 
              WHERE r.id = ?";  

    if ($stmt = $conex->prepare($query)) {
        $stmt->bind_param('i', $id); 

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No se encontraron datos.']);
        }
        $stmt->close();
    }
}
?>
