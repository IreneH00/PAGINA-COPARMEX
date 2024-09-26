<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];


    $stmt = $conex->prepare("UPDATE categoria SET nombre = ? WHERE id = ?");
    $stmt->bind_param("si", $nombre, $id);


    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'Categoria actualizada correctamente.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al actualizar el dato: ' . $stmt->error
        ];
    }


    $stmt->close();
} else {
    $response = [
        'status' => 'error',
        'message' => 'Método de solicitud no válido.'
    ];
}


echo json_encode($response);
