<?php
include 'conexion.php';

if (isset($_POST['qrUrl']) && isset($_POST['registro_id'])) {
    $qrUrl = $_POST['qrUrl'];
    $registro_id = $_POST['registro_id'];
    $rutaGuardado = 'qrs/';
    $nombreArchivo = uniqid('qr_') . '.png';
    $rutaCompleta = $rutaGuardado . $nombreArchivo;

    $imagenQR = file_get_contents($qrUrl);

    if ($imagenQR) {
        file_put_contents($rutaCompleta, $imagenQR);

        
        $query = "UPDATE registro_eventos_socios SET qr_code_path = ? WHERE id = ?";
        $stmt = $conex->prepare($query);
        $stmt->bind_param('si', $rutaCompleta, $registro_id);

        if ($stmt->execute()) {
            echo "Código QR guardado exitosamente en el servidor y URL actualizada.";
        } else {
            echo "Error al actualizar la base de datos: " . $stmt->error;
        }
    } else {
        echo "Error al descargar la imagen del código QR.";
    }
} else {
    echo "No se recibió ninguna URL de código QR o ID de registro.";
}
?>
