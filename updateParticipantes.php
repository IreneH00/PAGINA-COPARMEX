<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibe los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

   
    $stmt = $conex->prepare("UPDATE registro_eventos_socios SET  nombre = ?, correo = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);

   
    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'actualizado correctamente.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al actualizar los datos: ' . $stmt->error
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
?>
