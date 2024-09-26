<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        $query = "SELECT nombre, descripcion, precio, cantidad_total FROM productos WHERE id = ?";
        $stmt = $conex->prepare($query);

        if ($stmt) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            if ($data) {
                echo json_encode($data);
            } else {
                echo json_encode(['error' => 'No se encontró el equipo.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['error' => 'Error en la preparación de la consulta.']);
        }
    } else {
        echo json_encode(['error' => 'ID inválido.']);
    }

    $conex->close();
} else {
    echo json_encode(['error' => 'Método de solicitud inválido.']);
}
?>
