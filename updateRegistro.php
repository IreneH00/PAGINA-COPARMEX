<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $nombre_evento = $_POST['nombre_evento'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $activo = $_POST['activo'];
    $pagado = $_POST['pagado'];

    
    if ($id === false) {
        echo 'ID inválido.';
        exit;
    }

    $query = "UPDATE registro_eventos_socios SET 
              nombre_evento = ?, 
              nombre = ?, 
              telefono = ?, 
              correo = ?, 
              activo = ?, 
              pagado = ? 
              WHERE id = ?";

    $stmt = $conex->prepare($query);

    if ($stmt) {
        
        $stmt->bind_param('ssssssi', $nombre_evento, $nombre, $telefono, $correo, $activo, $pagado, $id);

      
        if ($stmt->execute()) {
            echo 'success'; 
        } else {
            echo 'Error al actualizar: ' . $stmt->error; 
        }

        $stmt->close();
    } else {
        echo 'Error en la preparación de la consulta.';
    }

    $conex->close();
} else {
    echo 'Método de solicitud inválido.';
}
?>
