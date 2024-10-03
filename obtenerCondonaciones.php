<?php
include 'conexion.php';


if (isset($_GET['socio_id'])) {
    $socio_id = intval($_GET['socio_id']); 

    $sql = "SELECT por_condonar FROM condonaciones WHERE socio_id = ? ORDER BY id DESC LIMIT 1";
    $stmt = $conex->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $socio_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $porCondonar = $row['por_condonar'];
        } else {
            $porCondonar = 0; 
        }

        $stmt->close();
    } else {
        
        echo json_encode(['error' => 'Error al preparar la consulta.']);
        exit();
    }
} else {
   
    echo json_encode(['error' => 'ID de socio no proporcionado.']);
    exit();
}

$conex->close();


echo json_encode(['porCondonar' => $porCondonar]);
?>
