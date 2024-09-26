<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$espacio = $_POST['espacio'];
$montaje = $_POST['montaje'];
$cantPersonas = $_POST['cantPersonas'];
$fechaInic = $_POST['fechaInic'];
$fechaFin = $_POST['fechaFin'];

$sql = "INSERT INTO aulas (nombre, correo, telefono, espacio, montaje, cantPersonas, fechaInic, fechaFin) VALUES ('$nombre', '$correo', '$telefono', '$espacio', '$montaje', '$cantPersonas', '$fechaInic', '$fechaFin')";


if (mysqli_query($conex, $sql)) {
    echo 'Se guardo correctamente';
} else {
    echo 'No se pudo cotizar, intenta de nuevo: ' . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conex);
