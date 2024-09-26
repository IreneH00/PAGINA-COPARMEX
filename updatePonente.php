<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $perfil = $_POST['perfil'];
    $puesto = $_POST['puesto'];
    $especialidad = $_POST['especialidad'];

   
    $stmt = $conex->prepare("UPDATE ponentes SET nombre = ?, perfil = ?, puesto = ?, especialidad = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nombre, $perfil, $puesto, $especialidad, $id);

   
    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'Ponente actualizado correctamente.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al actualizar los datos del ponente: ' . $stmt->error
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
