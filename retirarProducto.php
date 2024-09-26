<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'], $data['cantidad'], $data['motivo'])) {
        $idProducto = intval($data['id']);
        $cantidad = intval($data['cantidad']);
        $motivo = $data['motivo'];

       
        $checkQuery = "SELECT cantidad_total FROM productos WHERE id = ?";
        $stmtCheck = $conex->prepare($checkQuery);
        $stmtCheck->bind_param('i', $idProducto);
        $stmtCheck->execute();
        $stmtCheck->bind_result($cantidadTotal);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($cantidad > $cantidadTotal) {
            echo 'La cantidad a retirar es mayor que la cantidad disponible.';
            exit;
        }

        
        $updateQuery = "UPDATE productos SET cantidad_total = cantidad_total - ? WHERE id = ?";
        $stmt = $conex->prepare($updateQuery);
        $stmt->bind_param('ii', $cantidad, $idProducto);

        if ($stmt->execute()) {
           
            $historialQuery = "INSERT INTO historial (id_producto, motivo, cantidad, tipo_movimiento) VALUES (?, ?, ?, 'retirar')";
            $historialStmt = $conex->prepare($historialQuery);
            $historialStmt->bind_param('isi', $idProducto, $motivo, $cantidad);
            $historialStmt->execute();

            echo 'success';
        } else {
            echo 'Error al actualizar la cantidad del producto.';
        }
    } else {
        echo 'Datos incompletos.';
    }
} else {
    echo 'Método no permitido.';
}
