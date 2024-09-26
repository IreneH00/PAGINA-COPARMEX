<?php
include 'conexion.php';

// Obtén los datos JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Depuración: imprime los datos recibidos
error_log(print_r($data, true)); // Registra los datos en el log de errores

$id = isset($data['id']) ? $data['id'] : '';
$cantidad = isset($data['cantidad']) ? $data['cantidad'] : '';

// Verifica si los datos están vacíos
if (empty($id) || empty($cantidad)) {
    echo 'error: faltan datos';
    exit();
}

if (!is_numeric($cantidad) || $cantidad <= 0) {
    echo 'error: cantidad debe ser un número positivo';
    exit();
}

// Consulta la cantidad total del producto
$query = "SELECT cantidad_total FROM productos WHERE id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo 'error: fallo en la preparación de la consulta';
    exit();
}

$stmt->bind_param('i', $id);
if (!$stmt->execute()) {
    echo 'error: fallo en la ejecución de la consulta';
    exit();
}

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $cantidad_total = $row['cantidad_total'];

    if ($cantidad_total >= $cantidad) {
        // Actualiza la cantidad total del producto
        $nueva_cantidad = $cantidad_total - $cantidad;
        $updateQuery = "UPDATE productos SET cantidad_total = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        if (!$updateStmt) {
            echo 'error: fallo en la preparación de la consulta de actualización';
            exit();
        }

        $updateStmt->bind_param('ii', $nueva_cantidad, $id);
        if ($updateStmt->execute()) {
            echo 'success';
        } else {
            echo 'error: no se pudo actualizar el stock';
        }
    } else {
        echo 'error: material insuficiente';
    }
} else {
    echo 'error: producto no encontrado';
}

$conn->close();
?>
