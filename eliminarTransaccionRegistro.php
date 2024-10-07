<?php
session_start();
include 'conexion.php';

$id = $_POST['id'] ?? null;

if ($id === null) {
    echo json_encode(['error' => 'ID no proporcionado']);
    exit;
}

try {
    $conex->autocommit(false); 

    
    $deleteQuery = "DELETE FROM abonos_eventos WHERE id = ?";
    $stmtDeleteAbono = $conex->prepare($deleteQuery);
    $stmtDeleteAbono->bind_param("i", $id);
    $resultAbono = $stmtDeleteAbono->execute();

    if (!$resultAbono) {
        throw new Exception("Error al eliminar del registro de abonos");
    }


    $deleteQueryCondonacion = "DELETE FROM condonaciones_eventos WHERE id = ?";
    $stmtDeleteCondonacion = $conex->prepare($deleteQueryCondonacion);
    $stmtDeleteCondonacion->bind_param("i", $id);
    $resultCondonacion = $stmtDeleteCondonacion->execute();

    if (!$resultCondonacion) {
        throw new Exception("Error al eliminar del registro de condonaciones");
    }

   
    $conex->commit();
    echo json_encode(['success' => 'Registros eliminados correctamente']);
} catch (Exception $e) {
    $conex->rollBack(); 
    echo json_encode(['error' => 'Ocurrió un error al eliminar los registros: ' . $e->getMessage()]);
} finally {
    $conex->autocommit(true); 
}
?>
