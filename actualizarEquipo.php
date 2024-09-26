<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $equipo = $_POST['equipo'];
    $codigo = $_POST['codigo'];
    $caracteristicas = $_POST['caracteristicas'];

    if (!empty($id) && !empty($equipo) && !empty($codigo) && !empty($caracteristicas)) {
        $query = "UPDATE equipo SET Equipo = ?, No_Identificacion = ?, Caracteristicas = ? WHERE id = ?";
        $stmt = $conex->prepare($query);

        if ($stmt) {
            $stmt->bind_param('sssi', $equipo, $codigo, $caracteristicas, $id);
            $success = $stmt->execute();

            if ($success) {
                echo 'success';
            } else {
                echo 'Error en la actualización: ' . $conex->error;
            }

            $stmt->close();
        } else {
            echo 'Error en la preparación de la consulta: ' . $conex->error;
        }
    } else {
        echo 'Todos los campos son obligatorios.';
    }

    $conex->close();
} else {
    echo 'Solicitud inválida.';
}
?>
