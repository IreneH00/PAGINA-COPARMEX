<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_evento = $_POST['nombre_evento'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $activo = $_POST['activo'];
    $gratis = $_POST['gratis'];

    
    $query = "INSERT INTO registro_eventos_socios (nombre_evento, nombre, correo, telefono, activo, pagado) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conex->prepare($query);
    $pagado = ($gratis == 1) ? 1 : 0; 
    $stmt->bind_param("sssssi", $nombre_evento, $nombre, $correo, $telefono, $activo, $pagado);

    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
