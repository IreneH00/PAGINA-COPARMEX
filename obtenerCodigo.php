<?php
include 'conexion.php';
header('Content-Type: application/json');

$equipo = $_GET['equipo'] ?? '';

if ($equipo) {
    
    $query = "SELECT No_Identificacion FROM equipo WHERE Equipo = ? AND Estado = 'disponible'";
    $stmt = $conex->prepare($query);
    $stmt->bind_param('s', $equipo);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        $codigos = $result->fetch_all(MYSQLI_ASSOC);
        
        $codigoSeleccionado = $codigos[array_rand($codigos)]['No_Identificacion'];
        echo json_encode(['codigo' => $codigoSeleccionado]);
    } else {
        echo json_encode(['error' => 'No hay equipos disponibles para el equipo seleccionado.']);
    }

    $stmt->close();
    $conex->close();
} else {
    echo json_encode(['error' => 'Equipo no especificado.']);
}
?>
