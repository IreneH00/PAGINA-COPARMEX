<?php
include 'conexion.php'; 
if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = intval($_POST['cantidad']);

    $query = "INSERT INTO productos (nombre, descripcion, precio, cantidad_total) VALUES (?, ?, ?, ?)";

    if ($stmt = $conex->prepare($query)) {
        $stmt->bind_param('ssdi', $nombre, $descripcion, $precio, $cantidad);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
        $stmt->close();
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

$conex->close();
?>
