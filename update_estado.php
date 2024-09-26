<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $activo = intval($_POST['activo']);

    $sql = "UPDATE eventos SET activo = ? WHERE id = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param('ii', $activo, $id);

    if ($stmt->execute()) {
        echo "Estado actualizado correctamente";
    } else {
        echo "Error al actualizar el estado: " . $conex->error;
    }

    $stmt->close();
    $conex->close();
}
?>
