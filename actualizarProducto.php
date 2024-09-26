<?php
include 'conexion.php'; 

if (isset($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad_total'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad_total = $_POST['cantidad_total'];

  
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($cantidad_total)) {
        echo 'error: campos vacíos';
        exit;
    }

    
    $nombre = $conex->real_escape_string($nombre);
    $descripcion = $conex->real_escape_string($descripcion);
    $precio = floatval($precio);
    $cantidad_total = intval($cantidad_total);

    
    $query = "UPDATE productos SET 
              nombre = '$nombre', 
              descripcion = '$descripcion', 
              precio = $precio, 
              cantidad_total = $cantidad_total 
              WHERE id = $id";

    if ($conex->query($query) === TRUE) {
        echo 'success';
    } else {
        echo 'error: ' . $conex->error;
    }
} else {
    echo 'error: datos incompletos';
}
?>
