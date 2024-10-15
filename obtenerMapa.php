<?php
include 'conexion.php';

$eventoId = $_GET['id'] ?? null;

if ($eventoId) {
    
    $query = "SELECT * FROM mapa_asientos WHERE evento_id = ?";
    $stmt = $conex->prepare($query);
    $stmt->bind_param("i", $eventoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $mapa = $result->fetch_assoc();

        
        $query_asientos_ocupados = "SELECT num_mesa, num_asiento FROM asientos_ocupados WHERE evento_id = ?";
        $stmt_asientos = $conex->prepare($query_asientos_ocupados);
        $stmt_asientos->bind_param("i", $eventoId);
        $stmt_asientos->execute();
        $result_asientos = $stmt_asientos->get_result();

        $asientos_ocupados = [];
        while ($fila_asientos = $result_asientos->fetch_assoc()) {
            $asientos_ocupados[] = [
                'num_mesa' => $fila_asientos['num_mesa'],
                'num_asiento' => $fila_asientos['num_asiento']
            ];
        }

        $stmt_asientos->close();

        
        
        echo json_encode([
            'success' => true,
            'mapas' => [
                'num_mesas' => $mapa['num_mesas'],
                'asientos_por_mesa' => $mapa['asientos_por_mesa'],
                'asientos_mesa_principal' => $mapa['asientos_mesa_principal']
            ],
            'asientos_ocupados' => $asientos_ocupados
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se encontró mapa.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID de evento no válido.']);
}

$conex->close();
?>
