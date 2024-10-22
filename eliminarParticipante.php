<?php
//ELIMINAR EL PARTICIPANTE DE LA BD INCLUYENDO SU QR EN EL SERVIDOR
include 'conexion.php';

$id = $_POST['id'];


$sqlQr = "SELECT qr_code_path FROM registro_eventos_socios WHERE id='" . $id . "'";
$result = mysqli_query($conex, $sqlQr);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $qrCodePath = $row['qr_code_path'];

    
    if (file_exists($qrCodePath)) {
        unlink($qrCodePath); 
    }
}


$sql = "DELETE FROM registro_eventos_socios WHERE id='" . $id . "'";
if (mysqli_query($conex, $sql)) {
    echo 'Eliminado correctamente';
} else {
    echo 'No pudo eliminarse correctamente, intenta de nuevo';
}

mysqli_close($conex);
?>
