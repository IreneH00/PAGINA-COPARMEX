<?php
include 'conexion.php';
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$espacio = $_POST['espacio'];
$montaje = $_POST['montaje'];
$cantPersonas = $_POST['cantPersonas'];
$fechaInic = $_POST['fechaInic'];
$fechaFin = $_POST['fechaFin'];

$sql = "UPDATE aulas SET nombre = '" . $nombre . "', correo = '" . $correo . "', telefono = '" . $telefono . "', espacio= '" . $espacio . "', montaje= '" . $montaje . "' , cantPersonas= '" . $cantPersonas . "' , fechaInic= '" . $fechaInic . "' , fechaFin= '" . $fechaFin . "' WHERE  id = '" . $id . "'";

if ($datos = mysqli_query($conex, $sql)) {
    echo 'Registro actualizado con Éxito';
} else {
    echo 'No se pudo actualizar el registro, por favor intenta de nuevo';
}