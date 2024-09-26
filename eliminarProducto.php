<?php
include 'conexion.php'; 

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM productos WHERE id = ?";
    
    if ($stmt = $conex->prepare($query)) {
        $stmt->bind_param('i', $id);
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
