<?php

if (isset($_POST['qrUrl'])) {
    $qrUrl = $_POST['qrUrl'];
    $rutaGuardado = 'qrs/';  
    $nombreArchivo = uniqid('qr_') . '.png';
    $rutaCompleta = $rutaGuardado . $nombreArchivo;

    
    $imagenQR = file_get_contents($qrUrl);

    
    if ($imagenQR) {
        
        file_put_contents($rutaCompleta, $imagenQR);

        
        echo "Código QR guardado exitosamente en el servidor como: $nombreArchivo";
    } else {
    
        echo "Error al descargar la imagen del código QR.";
    }
} else {
  
    echo "No se recibió ninguna URL de código QR.";
}
