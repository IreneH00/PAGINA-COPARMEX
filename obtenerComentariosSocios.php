<?php
include 'conexion.php';


if (isset($_GET['socio_id'])) {
    $socio_id = intval($_GET['socio_id']); 

   
    $query = "SELECT * FROM comentarios_direccion WHERE socio_id = $socio_id";
    $result = $conex->query($query); 

    if ($result && $result->num_rows > 0) {
        $comentarios = [];

        while ($row = $result->fetch_assoc()) {
            $comentarios[] = $row;
        }

       
        echo json_encode($comentarios);
    } else {
        echo json_encode(['error' => 'No hay comentarios para este socio.']);
    }
} else {
    echo json_encode(['error' => 'ID de socio no proporcionado.']);
}


$conex->close(); 
?>
