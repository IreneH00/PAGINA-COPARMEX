<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = intval($_POST['id']);
    $activo = intval($_POST['activo']);
    $pagado = intval($_POST['pagado']);

    $sql = "UPDATE registro_eventos_socios SET activo = ?, pagado = ? WHERE id = ?";

    $stmt = $conex->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conex->error);
    }

    $stmt->bind_param('iii', $activo, $pagado, $id);

    if ($stmt->execute()) {
        echo "Estado actualizado correctamente";
    } else {
        echo "Error al actualizar el estado: " . $conex->error;
    }

    $stmt->close();
    $conex->close();
}
