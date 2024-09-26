<?php
include 'conexion.php';

header('Content-Type: application/json');

$response = array();

try {

    $id = $_POST['id'];
    $equipo = $_POST['equipo'];
    $nombreSolicitante = $_POST['nombreSolicitante'];
    $fechaSolicitud = $_POST['fechaSolicitud'];
    $fechaDevolucion = $_POST['fechaDevolucion'];
    $motivo = $_POST['motivo'];

    
    $fechaActual = date('Y-m-d');

  
    $queryEstadoAnterior = "SELECT Codigo_Identificacion FROM solicitudes WHERE id=?";
    $stmtEstadoAnterior = $conex->prepare($queryEstadoAnterior);
    $stmtEstadoAnterior->bind_param('i', $id);
    $stmtEstadoAnterior->execute();
    $resultEstadoAnterior = $stmtEstadoAnterior->get_result();
    $codigoIdentificacionAnterior = $resultEstadoAnterior->fetch_assoc()['Codigo_Identificacion'];
    $stmtEstadoAnterior->close();

   
    $query = "UPDATE solicitudes SET equipo=?, Nombre_solicitante=?, Fecha_solicitud=?, Fecha_devolucion=?, Motivo=? WHERE id=?";
    $stmt = $conex->prepare($query);
    $stmt->bind_param('sssssi', $equipo, $nombreSolicitante, $fechaSolicitud, $fechaDevolucion, $motivo, $id);

    if ($stmt->execute()) {
        
        if ($fechaDevolucion <= $fechaActual) {
           
            $updateEstadoQuery = "UPDATE equipo SET Estado='disponible' WHERE No_Identificacion=?";
        } else {
           
            $updateEstadoQuery = "UPDATE equipo SET Estado='en uso' WHERE No_Identificacion=?";
        }
        $updateStmt = $conex->prepare($updateEstadoQuery);
        $updateStmt->bind_param('s', $codigoIdentificacionAnterior);
        $updateStmt->execute();
        $updateStmt->close();
        
       
        if ($fechaDevolucion <= $fechaActual) {
         
            $updateEstadoAnteriorQuery = "UPDATE equipo SET Estado='disponible' WHERE No_Identificacion=?";
            $updateStmt = $conex->prepare($updateEstadoAnteriorQuery);
            $updateStmt->bind_param('s', $codigoIdentificacionAnterior);
            $updateStmt->execute();
            $updateStmt->close();
        }
        
        $response['success'] = 'Solicitud actualizada exitosamente.';
    } else {
        $response['error'] = 'Error al actualizar la solicitud.';
    }

    $stmt->close();
} catch (Exception $e) {
    $response['error'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);
?>
